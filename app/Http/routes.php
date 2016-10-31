<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::auth();


Route::group(['prefix' => 'admin','middleware'=>'auth','namespace'=>'Admin'],function(){
    // 控制台
    Route::get('/', 'HomeController@index');
    // 公众号管理
    Route::resource('wechat', 'WechatController', ['except' => ['create', 'edit']]);
    Route::resource('wechatMenu', 'WechatMenuController', ['except' => ['create', 'edit']]);
    Route::resource('wechatFollow', 'WechatFollowController', ['except' => ['create', 'edit']]);
});

Route::any('/wechat', 'WechatController@serve');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
    });
});

