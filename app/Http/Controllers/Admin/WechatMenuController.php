<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\WechatMenu;
use Illuminate\Support\Facades\Redirect;
use EasyWeChat\Foundation\Application;

class WechatMenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = WechatMenu::orderBy('parent_button', 'asc')->orderBy('sort', 'asc')->get();
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
                $menus[] = $item;
                $two_menu = array();
                foreach ($list as $key => $value) {
                    if ($value['parent_button'] != $item['id']) {
                        continue;
                    }
                    $value['name'] = '│─── ' . $value['name'];
                    $two_menu[] = $value;
                    unset($list[$key]);
                }
                $menus = array_merge($menus, $two_menu);
            }
        }

        return view('admin.wechat.menu.index')->with(['menus' => $menus]);
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
        return view('admin.wechat.menu.create')->with(['parent_menu' => $parent_menu]);
    }

    /**
     * 发送菜单至微信
     * 生成公众号菜单
     */
    public function pushMenu(){
		$wechat = app('wechat');
		$buttons = array();
		$menus = WechatMenu::where('parent_button','=',0)->orderBy('parent_button','asc')->orderBy('sort','asc')->get();
		
		foreach($menus as $i=>$menu){
			if($menu->type == 'none'){
				$buttons[$i] = ['name'=>$menu->name];
				$buttons[$i]['sub_button'] = array();
				$sub_menus = WechatMenu::where('parent_button','=',$menu->id)->orderBy('sort','asc')->get();
				foreach($sub_menus as $k=>$sub){
					if($sub->type == 'view'){
						$buttons[$i]['sub_button'][$k] = ['type'=>$sub->type, 'name'=>$sub->name, 'url'=>$sub->url];
					}else{
						$buttons[$i]['sub_button'][$k] = ['type'=>$sub->type, 'name'=>$sub->name, 'key'=>$sub->key];
					}
				}
			}elseif($menu->type == 'view'){
				$buttons[$i] = ['type'=>$menu->type, 'name'=>$menu->name, 'url'=>$menu->url];
			}elseif($menu->type == 'click'){
				$buttons[$i] = ['type'=>$menu->type, 'name'=>$menu->name, 'key'=>$menu->key];
			}	
		}
	
		$wechat->menu->destroy();
	
		$response = $wechat->menu->add($buttons);
		
		if($response->errmsg == 'ok'){
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单发送成功,5分钟之内公众号菜单会自动刷新');
		}else{
            return Redirect::to('admin/wechat/menu')->withError('菜单发送失！错误原因：' . $response->errmsg);
		}
	
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
        $menu = WechatMenu::findOrFail($id);
        $parent_menu = WechatMenu::where('parent_button', '=', 0)->get();
        return view('admin.wechat.menu.edit')->with(['menu' => $menu,'parent_menu'=>$parent_menu]);
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
        $type = $request->input('type');
        $parent_button = $request->input('parent_button');
        $menu = WechatMenu::find($id);

        $menu->sort = $request->input('sort');
        $menu->name = $request->input('name');
        $menu->type = $type;
        $menu->url = $request->input('url');
        $menu->key = $request->input('key');
        $menu->parent_button = $parent_button;
        if ($menu->save()) {
            return Redirect::to('admin/wechat/menu')->withSuccess('菜单修改成功');
        } else {
            return Redirect::to('admin/wechat/menu')->withError('菜单修改失败');
        }
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
