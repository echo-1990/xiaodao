<?php

namespace App\Http\Controllers\Web;

use App\Model\Cart;
use App\Model\Dog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class DogController extends Controller
{
    //
    public function index(Dog $dog)
    {
        $auth=authCheck();
        $openid=$auth['openid'];
        $is_login=$auth['is_login'];
        $user=$auth['user'];
        $cart=$auth['cart'];

        $dog->with(['good', 'pic', 'mother', 'father', 'vaccine', 'uninsect', 'video', 'weight', 'event', 'eventpic', 'reproduction']);
        $dog_cart=$dog->cart()->where('openid',$openid)->first();
        $address = getcity();
        return view('dogs', compact('dog', 'address', 'user', 'is_login', 'dog_cart','cart'));
    }
}
