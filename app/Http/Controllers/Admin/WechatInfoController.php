<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Wechat;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class WechatInfoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = Wechat::first();
        return view('admin.wechat.info.index')->with(['info'=>$info]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $wechat = new Wechat();
        $wechat->wechat_name = $request->input('wechat_name');
        $wechat->wechat_account = $request->input('wechat_account');
        $wechat->wechat_original_account = $request->input('wechat_original_account');
        $wechat->app_id = $request->input('app_id');
        $wechat->app_secret = $request->input('app_secret');
        $wechat->encodingaeskey = $request->input('encodingaeskey');
        $wechat->token = $request->input('token');
        $wechat->url = url('/wechat');
        if($wechat->save()){
            return Redirect::to('admin/wechat/info')->withSuccess('公众号信息录入成功');
        }else{
            return Redirect::to('admin/wechat/info')->withError('公众号信息录入失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $wechat = Wechat::find($id);
        $wechat->wechat_name = $request->input('wechat_name');
        $wechat->wechat_account = $request->input('wechat_account');
        $wechat->wechat_original_account = $request->input('wechat_original_account');
        $wechat->app_id = $request->input('app_id');
        $wechat->app_secret = $request->input('app_secret');
        $wechat->encodingaeskey = $request->input('encodingaeskey');
        $wechat->token = $request->input('token');
        if($wechat->save()){
            return Redirect::to('admin/wechat/info')->withSuccess('公众号信息修改成功');
        }else{
            return Redirect::to('admin/wechat/info')->withError('公众号信息修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
