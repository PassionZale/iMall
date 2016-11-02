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
        $list = WechatMenu::orderBy('sort','asc')->get();
        $menus = array();

        if (count($list)) {
            // 取出一级菜单 $level_one_menu
            foreach ($list as $index => $menu) {
                if ($menu['parent_button'] != 0) {
                    continue;
                }
                $level_one_menu[$menu['id']] = $menu;
                unset ($list [$index]);
            }

            // 合并二级菜单至一级菜单中
            foreach ($level_one_menu as $item) {
                $level_two_menu = array();
                foreach ($list as $key => $value) {
                    if ($value['parent_button'] != $item['id']) {
                        continue;
                    }
                    $value['name'] = '│─── ' . $value['name'];
                    $level_two_menu[] = $value;
                    unset($list[$key]);
                }
                $menus = array_merge($level_one_menu, $level_two_menu);
            }
        }

        return view('wechat.menu.index')->with(['menus' => $menus]);
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
            if ($type != 3) {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，一级菜单类型必须为“无事件”！');
            }
        } else {
            if ($type == 3) {
                return Redirect::to('admin/wechat/menu')->withError('菜单新增失败，二级菜单类型不能为“无事件”！');
            }
        }
        $menu = new WechatMenu();
        $menu->sort = $request->input('sort');
        $menu->name = $request->input('name');
        $menu->type = $type;
        $menu->url = $request->input('url');
        $menu->key = $request->input('key');
        $menu->parent_button = $parent_button;
        if ($menu->save()) {
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单新增成功');
        } else {
            return Redirect::to('admin/wechat/menu')->withError('菜单新增失败');
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
        dd(WechatMenu::find($id));
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
        $menu = WechatMenu::find($id);
        if ($menu) {
            // 删除菜单
            $menu->delete();
            $child_menu = WechatMenu::where('parent_button', '=', $id)->count();
            if ($child_menu) {
                // 若存在二级菜单，则删除二级菜单
                WechatMenu::where('parent_button', '=', $id)->delete();
            }
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单删除成功');
        } else {
            return Redirect::to('admin/wechat/menu')->withError('删除失败，未找到对应菜单');
        }
    }
}
