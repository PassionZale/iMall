<?php

namespace App\Http\Controllers\Mall;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

class IndexController extends Controller
{
    public function oauth(){
        session('wechat.oauth_user');
        return redirect()->to('mall');
    }

    public function index()
    {
        // 获取 OAuth 授权结果用户信息
        $user =  session('wechat.oauth_user');
        return view('mall.index')->with(['user' => $user]);
    }
}
