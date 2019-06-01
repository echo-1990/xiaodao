<?php
Route::group(['namespace'=>'Wx'],function(){

    Route::any('/','IndexController@index');
    Route::any('loginqrcode/','IndexController@getLoginQrcode');
});