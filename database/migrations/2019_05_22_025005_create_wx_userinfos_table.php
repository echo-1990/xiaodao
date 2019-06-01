<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxUserinfosTable extends Migration
{
    /**
     * Run the migrations.
     *"subscribe": 1,
    "openid": "o6_bmjrPTlm6_2sgVt7hMZOPfL2M",
    "nickname": "Band",
    "sex": 1,
    "language": "zh_CN",
    "city": "广州",
    "province": "广东",
    "country": "中国",
    "headimgurl":"http://thirdwx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/0",
    "subscribe_time": 1382694957,
    "unionid": " o6_bmasdasdsad6_2sgVt7hMZOPfL"
    "remark": "",
    "groupid": 0,
    "tagid_list":[128,2],
    "subscribe_scene": "ADD_SCENE_QR_CODE",
    "qr_scene": 98765,
    "qr_scene_str": ""
     * @return void
     */
    public function up()
    {
        Schema::create('wx_userinfos', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->tinyInteger('subscribe');
            $table->string('openid');
            $table->string('nickname');
            $table->tinyInteger('sex');
            $table->string('language');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('headimgurl');
            $table->integer('subscribe_time');
            $table->string('unionid');
            $table->string('remark');
            $table->integer('groupid');
            $table->string('tagid_list');
            $table->string('subscribe_scene');
            $table->string('qr_scene');
            $table->string('qr_scene_str');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wx_userinfos');
    }
}
