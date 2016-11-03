<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;

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
    public function serve()
    {
        Log::info('request arrived');

        $wechat = app('wechat');
        $server = $app->server;

        $server->setMessageHandler(function ($message) {
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case'subscribe':
                        $user = $message->FromUserName;
                        Text::setAttribute('content',"$user，欢迎关注iMall");
                        break;
                    case 'unsubscribe':
                        break;
                    default:
                        Text::setAttribute('content','iMall还在开发中...');
                }
            }
        });

        Log::info('return response');
        $response = $wechat->server->serve();
        return $response;
    }


}
