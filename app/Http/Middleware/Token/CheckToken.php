<?php

namespace App\Http\Middleware\Token;

use Closure;
use Illuminate\Support\Facades\Redis;
class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ( isset($_COOKIE["wx_login_token"])) {
            $token=$_COOKIE["wx_login_token"];
            $userinfo = Redis::get('token_' . $token);
            Redis::expire('token_' . $token, config('wechat.token_redis_exprice'));
            $user = json_decode($userinfo, true);
            if (isset($user['openid']) && strlen($user['openid']) > 20) {
                return $next($request);
            } else {
                return abort(401);
            }
        } else {
            return abort(401);
        }
    }
}
