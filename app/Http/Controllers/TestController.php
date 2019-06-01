<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test($id){
        dump($id);
//        $id=explode('.',$id);
//        return redirect()->action('UserController@tt',['id'=>$id[0]]);
//        return redirect()->away('https://www.baidu.com');
    }
}
