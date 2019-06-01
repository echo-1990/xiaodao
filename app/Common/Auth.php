<?php

use App\Model\Cart;
use Illuminate\Support\Facades\Redis;

function authCheck()
{
    if (isset($_COOKIE["wx_login_token"])) {
        $token = $_COOKIE["wx_login_token"];
        $userinfo = Redis::get('token_' . $token);
        Redis::expire('token_' . $token, config('wechat.token_redis_exprice'));
        $user = json_decode($userinfo, true);
        if (isset($user['openid'])) {
            $openid = $user['openid'];
            $is_login = strlen($openid) > 20;
            $cart = Cart::where('openid', $openid)->count();
        } else {
            $openid = 'openid';
            $user='';
            $cart = 0;
            $is_login = false;
        }
    } else {
        $openid = 'openid';
        $user='';
        $cart = 0;
        $is_login = false;
    }
    return compact('is_login', 'openid','user', 'cart');
}

//根据IP判断城市
function getcity()
{
    $ip = request()->ip();
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;//淘宝借口需要填写ip
    $ip = json_decode(file_get_contents($url));
    if ((string)$ip->code == '1') {
        return false;
    }
    $data = (array)$ip->data;
    return $data;
}

//获取微秒时间
function msectime()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}
