<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatSuggestion;

class UserController extends Controller
{
    public function userinfo()
    {
        $user = session('wechat.oauth_user')->toArray();
        return response()->json($user);
    }

    public function suggestion(Request $request)
    {
        $follow = session()->get('wechat.oauth_user');
        $suggestion = $request->input('suggestion');
        $suggest = new WechatSuggestion();
        $suggest->openid = $follow->id;
        $suggest->content = $suggestion;
        if ($suggest->save()) {
            return response()->json(['code' => 0]);
        } else {
            return response()->json(['code' => -1]);
        }
    }

}
