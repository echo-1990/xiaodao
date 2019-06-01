<?php

namespace App\Http\Controllers\Wx;

use App\Model\Qrcodelog;
use App\Model\Wx_userinfo;
use App\Model\User;
use App\Http\Controllers\Controller;
use Log;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    //微信服务器对接
    public function index()
    {
        /**
         * $app->server->push()消息处理器
         * use EasyWeChat\Kernel\Messages\Message;
         *
         */
        Log::info('request arrived.');
//        $openid='or7Wt01vFnW2tr89vYqtQRcth0Ns';
        $app = app('wechat.official_account');
        $app->server->push(function ($message) {

            switch ($message['MsgType']) {
                case 'event':
                    if ($message['Event'] == 'subscribe' || $message['Event'] == 'SCAN') {
                        $this->wxRegister($message['FromUserName']);
                        $userinfo = $this->getUserInfo($message['FromUserName']);
                        $ek = explode('_', $message['EventKey']);
                        if ($ek[0] == 'login') {
                            Redis::hmset($message['EventKey'],
                                'openid', $message['FromUserName'],
                                'userinfo', json_encode($userinfo)
                            );
                            Redis::expire($message['EventKey'], config('wechat.scanqrcode_exprice'));

                            Redis::publish($message['EventKey'], json_encode($userinfo));
                        }
                    } elseif ($message['Event'] == 'unsubscribe') {

                    } else {

                    }
                    break;

                case 'text':
                    break;

                default:
                    break;
            }
        });
        return $app->server->serve();
    }

    //返回登录用二维码url和code
    public function getLoginQrcode()
    {

        $ip = request()->ip();
        if (Redis::get('loginqrcode_' . $ip) >= config('wechat.getloginqrcode_times')) {
            return " Over-frequent visits ";
        } else {
            Redis::incr('loginqrcode_' . $ip);
            Redis::expire('loginqrcode_' . $ip, config('wechat.getloginqrcode_exprice'));

            $time = msectime();
            $logincode = 'login_' . $ip . '_' . $time;
            $Qrcode = array();
            $Qrcode['url'] = $this->getQrcode($logincode, config('wechat.loginqrcode_exprice'));
            $Qrcode['code'] = $logincode;

            $q = new Qrcodelog;
            $q->qrcode = $logincode;
            $q->type = config('wechat.loginqrcode_exprice');
            $q->usefor = 'login';
            $q->save();

            return $Qrcode;
        }
    }

    //user表，无则插入
    public function wxRegister($openid)
    {
        User::updateOrCreate(['openid' => $openid]);
    }

    //获取二维码
    public function getQrcode($key, $type)
    {
        $app = app('wechat.official_account');
        if ($type == 'forever') {
            $qrcode = $app->qrcode->forever($key);

        } else {
            $qrcode = $app->qrcode->temporary($key, $type);
        }

        if (!empty($qrcode['ticket'])) {
            return $app->qrcode->url($qrcode['ticket']);
        } else {
            return false;
        }
    }

    //获取7天有效期的用户信息
    public function getUserInfo($openid)
    {

        $info = Wx_userinfo::where('openid', $openid)->first();
        if ((strtotime(date("y-m-d h:i:s")) - strtotime($info['updated_at'])) < 7 * 24 * 3600) {
            return $info;
        }
        $app = app('wechat.official_account');
        $userinfo = $app->user->get($openid);
        $userinfo['tagid_list'] = implode(",", $userinfo['tagid_list']);
        Wx_userinfo::updateOrCreate(['openid' => $openid], $userinfo);
        return $userinfo;
    }

    //::TODO
    //用户关注后的事件，关注后判断注册账户，取关后更新关注状态
    public function unsubscribe()
    {

    }
}
