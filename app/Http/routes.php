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

// 与微信服务器交互请求
Route::any('/wechat', 'WechatController@serve');

// 微信商城
Route::group(['prefix'=>'mall','middleware' => ['web', 'wechat.oauth'],'namespace'=>'Mall'],function(){
    // OAuth2.0 授权 snsapi_userinfo
    Route::get('/user', 'IndexController@oauth');
    // 首页
    Route::get('/','IndexController@index');
});

Route::group(['prefix'=>'api','middleware'=>'web','namespace'=>'Api'],function(){
    Route::get('userinfo','UserController@userinfo');
});