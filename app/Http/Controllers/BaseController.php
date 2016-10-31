<?php

namespace App\Http\Controllers;

use Menu;

class BaseController extends Controller
{

    protected $menu;

    public function __construct()
    {
        // 定义Auth中间件
        $this->middleware('auth');
        // 设置CMS菜单
        $menuCollection = Menu::make('MyNavBar', function ($menu) {
            $menu->add('控制台','');
            $wechat = $menu->add('公众号管理', '#');
            $wechat->add('基础信息', '#');
            $wechat->add('菜单设置', '#');
            $wechat->add('粉丝列表','#');
        });
        $this->menu = $menuCollection;
    }


}