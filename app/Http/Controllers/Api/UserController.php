<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userinfo(){
        $user = session('wechat.oauth_user')->toArray();
        return response()->json($user);
    }
}
