<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ShopBanner;
use Image;

class ShopBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = ShopBanner::paginate(10);
        return view('admin.shop.banner.index')->with(['banners' => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new ShopBanner();
        $banner->title = $request->input('title');
        if($request->input('redirect_url')!= ''){
            $banner->redirect_url = $request->input('redirect_url');
        }
        $banner->sort = $request->input('sort');
        $banner->disabled = $request->input('disabled');
        $banner->img_url = NULL;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/banner/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $banner->img_url = $filePath . $fileName;
        }
        $banner->save();
        return redirect()->to('admin/shop/banner')->withSuccess('新增轮播图成功！');
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
        $banner = ShopBanner::find($id);
        if($banner){
            return view('admin.shop.banner.edit')->with(['banner'=>$banner]);
        }else{
            return redirect()->to('admin/shop/banner')->withError('对应轮播图不存在！');
        }
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
        $banner = ShopBanner::find($id);
        $banner->title = $request->input('title');
        if($request->input('redirect_url')!= ''){
            $banner->redirect_url = $request->input('redirect_url');
        }
        $banner->sort = $request->input('sort');
        $banner->disabled = $request->input('disabled');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/banner/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $banner->img_url = $filePath . $fileName;
        }
        $banner->save();
        return redirect()->to('admin/shop/banner')->withSuccess('修改轮播图成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = ShopBanner::find($id);
        if($banner){
            $banner->delete();
            return redirect()->to('admin/shop/banner')->withSuccess('删除轮播图成功！');
        }else{
            return redirect()->to('admin/shop/banner')->withError('删除失败，未找到对应轮播图！');
        }
    }
}
