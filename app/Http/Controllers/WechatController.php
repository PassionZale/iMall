<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use EasyWeChat\Foundation\Application;
use App\WechatFollow;

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

	public function debug(){
		$openid = 'orhIDvxpqL9woREoYLYCKZGrD52k';
		$app = app('wechat');
//		dd($app->access_token->getToken());
		dd($app->user->get($openid));
	}

    public function serve()
    {

        $wechat = app('wechat');
        $server = $wechat->server;
		$userApi = $wechat->user;

        $server->setMessageHandler(function ($message) use($userApi) {
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case'subscribe':
						// 录入粉丝信息
						$openId = $message->FromUserName;
						$user = $userApi->get($openId);	

						$follow = new WechatFollow();
						$follow->openid = $openId;
						$follow->nickname = $user->nickname;
						$follow->sex = $user->sex;
						$follow->language = $user->language;
						$follow->city = $user->city;
						$follow->country = $user->country;
						$follow->province = $user->province;
						$follow->headimgurl = $user->headimgurl;
						$follow->remark = $user->remark;
						$follow->groupid = $user->groupid;
						$follow->is_subscribed = 2;
						$follow->save();
						return '欢迎，' . $user->nickname . '。';
                        break;
                    case 'unsubscribe':
						$follow = WechatFollow::where('openid', '=', $message->FromUserName)->get();
						if($follow){
							$follow->is_subscribed = "1";
							$follow->save();
						}
                        break;
                    default:
						return '';
						break;
                }
            }else{
				$user =  $userApi->get($message->FromUserName);	
				return 'Hi,' . $user->nickname . ', iMall还在开发中.';
			}
        });

		return $server->serve();
    }


}
