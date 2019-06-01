<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Address;
use App\Model\Cart;
use App\Http\Controllers\Web\DogController;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Model\Good;

class OrderController extends Controller
{
    public function addCart($dog_id)
    {
        $auth = authCheck();
        $openid = $auth['openid'];
        if (strlen($openid) > 20) {
            Cart::withTrashed()
                ->updateOrcreate([
                    'openid' => $openid,
                    'dog_id' => $dog_id],
                    ['deleted_at' => null]
                );
            return "success";
        } else {
            return "get auth error";
        }
    }

    public function delCart($dog_id)
    {
        $auth = authCheck();
        $openid = $auth['openid'];
        if (strlen($openid) > 20) {
            Cart::where('openid', $openid)
                ->where('dog_id', $dog_id)
                ->delete();
            return 'success';
        } else {
            return "get auth error";
        }
    }

    public function getCart()
    {
        $auth = authCheck();
        $openid = $auth['openid'];
        if (strlen($openid) > 20) {
            $cart = Cart::where('openid', $openid)
                ->with('good')
                ->get();
            return response($cart)->header('xd-name', 'xujaintao');
        } else {
            return "get auth error";
        }
    }

    public function addOrder(Request $request)
    {
        /**
         * 获取默认地址数据
         *根据dog_id找到商品信息
         * 根据商品信息判断是否代办
         * 根据商品是否是可购买状态
         */
        //根据token查找用户信息
        $user = authCheck();
        $address = Address::where('openid', $user['openid'])->first();
        $dog_id = $request->addtocart;
        $price = $request->select;
        $goods = Good::where('dog_id', $dog_id)->first();

        return view('order', compact('user','address', 'dog_id', 'price', 'goods'));
    }

    public function saveOrder(Request $request)
    {
        /**
         * 有则更新无则创建address
         * 在订单中也要保存address
         * 验证商品状态
         * 生成订单
         * 生成支付
         */

        Address::updateOrcreate(
            ['openid' => $request->openid],
            [
                'province' => $request->province,
                'city' => $request->city,
                'area' => $request->area,
                'addressinfo' => $request->addressinfo,
                'phone' => $request->phone,
                'phonecheck' => 0
            ]);

        $goods = Good::where('dog_id', $request->dog_id)->first();
        if ($goods->type != 0) {
            return response("goods_type error");
        }
//::TODO 缺少价格，到微信生成订单
        $orderdata=$request->only('province','city','area','addressinfo','phone','openid','dog_id','certificate_type');
        Order::create($orderdata);

    }


}
