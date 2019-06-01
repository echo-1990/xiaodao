<?php

namespace App\Http\Controllers\Web;

use App\Model\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    /**
     * 2019-05-21
     * Create By Echo
     *
     */
    //首页
    public function index()
    {
        $auth=authCheck();
        $openid=$auth['openid'];
        $is_login=$auth['is_login'];
        $user=$auth['user'];
        $cart=$auth['cart'];
        $url=URL::signedRoute('unsubscribe', ['user' => 1]);
        dump($url);
        return view('index', compact('user', 'is_login','cart'));
    }

}
