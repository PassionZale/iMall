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
        Route::resource('menu', 'WechatMenuController');
        Route::post('pushMenu','WechatMenuController@pushMenu');
        Route::resource('follow', 'WechatFollowController', ['except' => ['create']]);
    });
});

// DEBUG
Route::get('/wechat/debug','WechatController@debug');

Route::any('/wechat', 'WechatController@serve');

// 微信商城首页
Route::group(['prefix'=>'mall','middleware' => ['web', 'wechat.oauth'],'namespace'=>'Mall'],function(){
    Route::get('/user', 'IndexController@oauth');
    Route::get('/','IndexController@index');
});

//Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
//    Route::get('/user', function () {
//        session('wechat.oauth_user'); // 拿到授权用户资料
//    });
//});

