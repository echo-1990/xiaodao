<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    public function test(Request $request){
        dump($request->id);

//        $id=explode('.',$id);
//        return redirect()->action('UserController@tt',['id'=>$id[0]]);
//        return redirect()->action('UserController@tt');
//        return redirect()->away('https://www.baidu.com');
    }
    public function tt($id=1){
        dump($id);
    }

    //getpcode,发送手机验证码
    public function getPcode(){

    }

    //验证手机验证码并登陆
    public function checkPcode(){

    }

    //查询二维码扫描状态
    public function whoScan($key){
        $code=explode('_',$key);
        $ip=request()->ip();
        if(isset($code[1])){
            if($code[1] != $ip){
                return "address error";
            }
            Redis::subscribe($key,function($message,$channelName)use($key){
                Redis::unsubscribe();
                $token=$this->getToken($message,$key);
                echo $token;
                die();
            });

        }else{
            return "code error";
        }
    }



    //登录颁发Token
    public function getToken($message,$key){
        $token=base64_encode($key);
        Redis::set('token_'.$token,$message);
        Redis::expire('token_'.$token,config('wechat.token_redis_exprice'));
        return $token;
    }

    public function logout(){
        $token = $_COOKIE["wx_login_token"];
        return Redis::del('token_'.$token);
    }

}
