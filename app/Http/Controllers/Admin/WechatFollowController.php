<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\WechatFollow;
use EasyWeChat\Foundation\Application;

class WechatFollowController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $follows = WechatFollow::paginate(10);
        return view('admin.wechat.follow.index')->with(['follows' => $follows]);
    }

    public function refresh(Request $request)
    {
        $openid = $request->input('openid');
        $follow = WechatFollow::where('openid', '=', $openid)->first();
        if ($follow) {
            $wechat = app('wechat');
            $userApi = $wechat->user;
            // 重新获取粉丝基础信息
            $user = $userApi->get($openid);
            $data['nickname'] = $user->nickname;
            $data['sex'] = ($user->sex + 1);
            $data['language'] = $user->language;
            $data['city'] = $user->city;
            $data['country'] = $user->country;
            $data['province'] = $user->province;
            $data['headimgurl'] = $user->headimgurl;
            $data['remark'] = $user->remark;
            $data['groupid'] = $user->groupid;
            WechatFollow::where('openid', '=', $openid)->update($data);
            return redirect()->to('admin/wechat/follow')
                ->withSuccess('粉丝：  '. $follow['nickname'] . '  更新成功！');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
