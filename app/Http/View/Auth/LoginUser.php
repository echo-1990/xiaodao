<?php

namespace App\Http\View\Auth;

use App\Model\Cart;
use Illuminate\View\View;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redis;


class LoginUser
{
    public function __construct()
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
        $this->authuserinfo = compact('is_login', 'openid','user', 'cart');
    }

    public function compose(View $view)
    {
        $view->with('authuserinfo', $this->authuserinfo);
    }
}