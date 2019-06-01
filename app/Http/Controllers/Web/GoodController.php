<?php

namespace App\Http\Controllers\Web;

use App\Model\Cart;
use App\Model\Good;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Validator;
use Illuminate\Validation\Rule;

class GoodController extends Controller
{
    //
    public function index($order = 'created_at', $by = 'desc', $type = 100, $minp = 0, $maxp = 50000)
    {
        $auth=authCheck();
        $openid=$auth['openid'];
        $is_login=$auth['is_login'];
        $user=$auth['user'];
        $cart=$auth['cart'];

        $date = compact('order', 'by', 'type', 'minp', 'maxp');


        //验证数据
        $validator = Validator::make($date, [
            'order' => ['required',Rule::In(['created_at', 'price', 'birth_at']),],
            'by' => ['required',Rule::In(['desc', 'asc']),],
            'type' => 'required|integer',
            'minp' => 'required|integer',
            'maxp' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        //逻辑
        $goods = Good::orderBy($order, $by)
            ->whereBetween('price', [$minp * 100, $maxp * 100])
            ->when($type != 100, function ($query) use ($type) {
                return $query->where('goods_type', $type);
            })
            ->with(['dog', 'pic'])
            ->has('pic')
            ->has('dog')
            ->paginate(3);


        return view('goods', compact('goods', 'count', 'order', 'by', 'type', 'minp', 'maxp', 'user', 'is_login','cart'));
    }
}
