<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use EasyWeChat\Foundation\Application;
use App\WechatFollow;
use App\WechatMenu;

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

    public function debug()
    {

    }

    public function serve()
    {

        $wechat = app('wechat');
        $server = $wechat->server;
        $userApi = $wechat->user;

        $server->setMessageHandler(function ($message) use ($userApi) {
            // 获取当前粉丝openId
            $openid = $message->FromUserName;

            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case'subscribe':
                        // 获取当前粉丝基本信息
                        $user = $userApi->get($openid);
                        // 判断当前粉丝是否以前关注过
                        $oldFollow = WechatFollow::where('openid', '=', $openid)->first();
                        if ($oldFollow) {
                            $follow['nickname'] = $user->nickname;
                            $follow['sex'] = ($user->sex + 1);
                            $follow['language'] = $user->language;
                            $follow['city'] = $user->city;
                            $follow['country'] = $user->country;
                            $follow['province'] = $user->province;
                            $follow['headimgurl'] = $user->headimgurl;
                            $follow['remark'] = $user->remark;
                            $follow['groupid'] = $user->groupid;
                            $follow['is_subscribed'] = 2;
                            WechatFollow::where('openid', '=', $openid)->update($follow);
                            return '欢迎回来，' . $user->nickname . '。';
                        } else {
                            // 录入数据库
                            $follow = new WechatFollow();
                            $follow->openid = $openid;
                            $follow->nickname = $user->nickname;
                            $follow->sex = ($user->sex + 1);
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
                        }
                        break;
                    case 'unsubscribe':
                        WechatFollow::where('openid', '=', $openid)->update(['is_subscribed' => 1]);
                        break;
                    default:
                        return '';
                        break;
                }
            } else {
                $user = $userApi->get($openid);
                return 'Hi,' . $user->nickname . ', iMall还在开发中.';
            }
        });

        return $server->serve();
    }


}
