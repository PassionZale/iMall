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

        $app = app('wechat');
        $server = $app->server;

        $server->setMessageHandler(function ($message) {
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case'subscribe':
						return '欢迎。';
                        break;
                    case 'unsubscribe':
                        break;
                    default:
						return '';
						break;
                }
            }else{
					
				return 'iMall还在开发中...Comming soon';
			}
        });

        Log::info('return response');
		return $server->serve();
    }


}
