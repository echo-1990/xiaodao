<?php
use App\Http\Controllers\Web\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','IndexController@index');
Route::any('goods/{order?}/{by?}/{type?}/{minp?}/{maxp?}','GoodController@index');
Route::get('doginfo/{dog}','DogController@index');
Route::get('whoscan/{qrcode}','UserController@whoScan')->name('unsubscribe');
Route::get('tt/{id}','UserController@test');
Route::get('t/{id}','UserController@test')->middleware('catid');


Route::group(['middleware'=>'CheckToken'],function(){
    Route::get('logout/','UserController@logout');
    Route::get('addcart/{dog_id}','OrderController@addCart');
    Route::get('delcart/{dog_id}','OrderController@delCart');
    Route::get('getcart/','OrderController@getCart');
    Route::post('addorder/','OrderController@addOrder');
    Route::post('saveorder/','OrderController@saveOrder');
});

