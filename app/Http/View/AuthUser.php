<?php
namespace App\Http\View\Auth;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Model\Cart;
use Illuminate\Support\Facades\Redis;
class AuthUser
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
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
            $this->userinfo = compact('is_login', 'openid','user', 'cart');
    }

    public function compose(View $view)
    {
        $view->with('userinfo', $this->userinfo);
    }
}
