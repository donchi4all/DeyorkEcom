<?php

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


Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'OrdersController@index');

    Route::resource('order', 'OrdersController');
    

    Route::get('logout', function (){
        Auth::logout();
        return redirect('/');
    });

    Route::get('orders/new', 'OrdersController@new')->name('order.new');
    Route::get('orders/shipped', 'OrdersController@shipped')->name('order.shipped');
    Route::get('orders/delivered', 'OrdersController@delivered')->name('order.delivered');
    Route::get('orders/cancelled', 'OrdersController@cancelled')->name('order.cancelled');
    Route::get('orders/returned', 'OrdersController@returned')->name('order.returned');
    Route::get('invoice', 'OrdersController@invoice')->name('order.invoice');


    Route::get('tracking', 'TrackingsController@index')->name('track.index');
    Route::get('tracking/search/{order_code}', 'TrackingsController@tracking')->name('track.tracking');
   

    Route::get('order/print/{id}', 'OrdersController@print')->name('order.print');
    Route::get('password', 'OrdersController@processing')->name('order.processing');
   
    Route::get('/addTocart', 'OrdersController@add_cart')->name('order.cart');

 
Route::resource('user', 'UsersController')->except(['show','Edit']);


    //making user id optional in taking
    Route::get('show/{id?}','UsersController@show')
    ->name('user.show');
    Route::get('edit/{id?}','UsersController@edit')
    ->name('user.edit');

Route::resource('setting', 'SettingsController');

Route::get('myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'OrdersController@myformAjax'));
Route::get('order/status/{id}/{status}',array('as'=>'order.status','uses'=>'OrdersController@changeStatus'));
});
