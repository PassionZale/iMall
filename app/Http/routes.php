<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::auth();

// 控制台
Route::get('/', 'Admin\HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    // 公众号管理
    Route::group(['prefix' => 'wechat'], function () {
        Route::resource('info', 'WechatInfoController', ['except' => ['create', 'edit']]);
        Route::resource('menu', 'WechatMenuController');
        Route::post('pushMenu', 'WechatMenuController@pushMenu');
        Route::resource('follow', 'WechatFollowController', ['except' => ['create']]);
        Route::get('refresh', 'WechatFollowController@refresh');
    });
    // 店铺管理
    Route::group(['prefix' => 'shop'], function () {
        Route::resource('config', 'ShopConfigController', ['except' => ['create', 'edit','show','destroy']]);
        Route::resource('banner', 'ShopBannerController');
    });
    // 商品管理
    Route::group(['prefix'=>'product'],function(){
        Route::resource('topic','ProductTopicController');
        Route::resource('plate','ProductPlateController');
        Route::resource('category','ProductCategoryController');
        Route::resource('commodity','ProductCommodityController');
        // Ajax Route
        Route::get('getTreeData','ProductCategoryController@treeData');
        Route::get('getTableData','ProductCommodityController@tableData');
        // 富文本编辑器上传图片
        Route::post('editorUpload','ProductCommodityController@editorUpload');
    });
});

// DEBUG
Route::get('/wechat/debug', 'WechatController@debug');

// Wechat http main route
Route::any('/wechat', 'WechatController@serve');

// 微信商城
Route::group(['prefix' => 'mall', 'middleware' => ['web', 'wechat.oauth'], 'namespace' => 'Mall'], function () {
    // Wechat OAuth2.0 (type=snsapi_userinfo)
    Route::get('/user', 'IndexController@oauth');
    // 首页
    Route::get('/', 'IndexController@index');
});

Route::group(['prefix' => 'api', 'middleware' => 'web', 'namespace' => 'Api'], function () {
    Route::get('userinfo', 'UserController@userinfo');
    Route::get('banners', 'ShopController@getBanners');
    Route::get('topics','ShopController@getTopics');
    Route::get('plates','ShopController@getPlates');
    Route::get('categories','ShopController@getCategories');
    Route::post('commodities/{$id}/topic','ShopController@getCommodityByTopic');
});