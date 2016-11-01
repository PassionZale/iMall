<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::auth();

// 控制台
Route::get('/', 'Admin\HomeController@index');

Route::group(['prefix' => 'admin','middleware'=>'auth','namespace'=>'Admin'],function(){
    // 公众号管理
    Route::group(['prefix'=>'wechat'],function (){
        Route::resource('info', 'WechatInfoController', ['except' => ['create', 'edit']]);
        Route::resource('menu', 'WechatMenuController', ['except' => ['create', 'edit']]);
        Route::resource('follow', 'WechatFollowController', ['except' => ['create', 'edit']]);
    });
});

Route::any('/wechat', 'WechatController@serve');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
    });
});

