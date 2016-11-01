<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\WechatMenu;
use Illuminate\Support\Facades\Redirect;

class WechatMenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wechat.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询全部一级菜单（parent_button = 0）
        $parent_menu = WechatMenu::where('parent_button', '=', 0)->get();
        return view('wechat.menu.create')->with(['parent_menu' => $parent_menu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = WechatMenu::where('parent_button', '=', 0)->count();
        $type = $request->input('type');
        $parent_button = $request->input('parent_button');
        if ($parent_button == 0) {
            if ($count >= 3) {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，一级菜单至多设置3个！');
            }
            if($type != 3){
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，一级菜单类型不能为“无事件”！');
            }
        } else {
            if ($type == 3) {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，二级菜单类型不能为“无事件”！');
            }
            $menu = new WechatMenu();
            $menu->sort = $request->input('sort');
            $menu->name = $request->input('name');
            $menu->type = $request->input('type');
            $menu->url = $request->input('url');
            $menu->key = $request->input('key');
            $menu->parent_button = $request->input('parent_button');
            if ($menu->save()) {
                return Redirect::to('admin/wechat/menu')->withSuccess('菜单新增成功');
            } else {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败');
            }
        }
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
        return view('wechat.menu.edit');
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
