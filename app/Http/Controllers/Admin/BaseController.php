<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use View;

class BaseController extends Controller
{

    protected $module;
    protected $parent_module;

    public function __construct()
    {
        // 定义Auth中间件
        $this->middleware('auth');
        // 菜单导航高亮
        View::share('active', [$this->module => 'active']);
        View::share('parent_module', [$this->parent_module = 'active']);
    }


}