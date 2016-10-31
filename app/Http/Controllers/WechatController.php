<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use EasyWeChat\Foundation\Application;

/**
 * Class WechatController
 * @package App\Http\Controllers
 */
class WechatController extends Controller
{

    /**
     * 处理微信请求
     *
     * @param Application $wechat
     * @return mixed
     */
    public function serve(Application $wechat)
    {
        Log::info('request arrived');

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            return "欢迎关注 overtrue！";
        });

        Log::info('return response');
        return $wechat->server->serve();
    }

    
}
