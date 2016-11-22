<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ShopConfig;

class ShopConfigController extends Controller
{
    public function index()
    {
        $configs = ShopConfig::first();
        return view('admin.shop.config.index')->with(['configs'=>$configs]);
    }

    public function store(Request $request)
    {
        $config = new ShopConfig();
        $config->config_name = $request->input('config_name');
        $config->config_freight = $request->input('config_freight');
        $config->config_free = $request->input('config_free');

        if($config->save()){
            return redirect()->to('admin/shop/config')->withSuccess('商铺配置录入成功');
        }else{
            return redirect()->to('admin/shop/config')->withError('商铺配置录入失败');
        }

    }

    public function update(Request $request, $id)
    {
        $config = ShopConfig::find($id);
        $config->config_name = $request->input('config_name');
        $config->config_freight = $request->input('config_freight');
        $config->config_free = $request->input('config_free');
        if($config->save()){
            return redirect()->to('admin/shop/config')->withSuccess('商铺配置修改成功');
        }else{
            return redirect()->to('admin/shop/config')->withError('商铺配置修改失败');
        }
    }

}
