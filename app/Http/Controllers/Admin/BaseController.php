<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use View;

class BaseController extends Controller
{

    public function __construct()
    {
        // 定义Auth中间件
        $this->middleware('auth');
    }


}