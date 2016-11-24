<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductCommodity;
use App\ProductCategory;
use App\ProductPlate;
use App\ProductTopic;
use Image;

class ProductCommodityController extends Controller
{
    public function index()
    {
        $commodities = ProductCommodity::paginate(8);
        return view('admin.product.commodity.index')->with(['commodities' => $commodities]);
    }

    public function tableData(Request $request)
    {
        $category = ProductCategory::where('category_name', '=', $request->input('name'))->first();
        if ($category->parent_id == 0) {
            $sub_categories = ProductCategory::where('parent_id', '=', $category->id)->get();
            $sub_categories->transform(function ($item, $key) {
                return $item->id;
            });
            $sub_id = $sub_categories->all();
            $commodities = ProductCommodity::whereIn('category_id', $sub_id)->get();
        } else {
            $commodities = ProductCommodity::where('category_id', '=', $category->id)->get();
        }
        return response()->json($commodities);
    }

    public function create()
    {
        $categories = ProductCategory::where('parent_id', '>', 0)->orderBy('id', 'desc')->get();
        $plates = ProductPlate::where('disabled', '=', '显示')->orderBy('id', 'desc')->get();
        $topics = ProductTopic::where('disabled', '=', '显示')->orderBy('id', 'desc')->get();
        return view('admin.product.commodity.create')
            ->with(['categories' => $categories, 'plates' => $plates, 'topics' => $topics]);
    }

    public function store(Request $request)
    {
        $commodity = new ProductCommodity();
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/commodity/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $commodity->commodity_img = $filePath . $fileName;
        }
        $commodity->commodity_name = $request->input('commodity_name');
        $commodity->commodity_number = $request->input('commodity_number');
        $commodity->commodity_original_price = $request->input('commodity_original_price');
        $commodity->commodity_current_price = $request->input('commodity_current_price');
        $commodity->commodity_stock_number = $request->input('commodity_stock_number');
        $commodity->commodity_sold_number = $request->input('commodity_sold_number');
        $commodity->commodity_detail_info = $request->input('commodity_detail_info');
        $base_info = $request->input('commodity_base_info');
        $placeholder = "======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。";
        if ($base_info != $placeholder) {
            $commodity->commodity_base_info = $base_info;
        }
        $commodity->commodity_disabled = $request->input('commodity_disabled');
        $commodity->commodity_sort = $request->input('commodity_sort');
        $commodity->topic_id = $request->input('topic_id');
        $commodity->plate_id = $request->input('plate_id');
        $commodity->category_id = $request->input('category_id');
        if ($commodity->save()) {
            return redirect()->to('admin/product/commodity')->withSuccess('新增商品成功！');
        } else {
            return redirect()->to('admin/product/commodity')->withError('新增商品失败！');
        }
    }

    public function editorUpload(Request $request)
    {
        if ($request->hasFile('editorFile') && $request->file('editorFile')->isValid()) {
            $filePath = '/uploads/editor/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('editorFile'))
                ->encode('png')
                ->save('.' . $filePath . $fileName);
            return $filePath . $fileName;
        } else {
            return "error|上传失败！";
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $commodity = ProductCommodity::findOrFail($id);
        $categories = ProductCategory::where('parent_id', '>', 0)->orderBy('id', 'desc')->get();
        $plates = ProductPlate::where('disabled', '=', '显示')->orderBy('id', 'desc')->get();
        $topics = ProductTopic::where('disabled', '=', '显示')->orderBy('id', 'desc')->get();
        return view('admin.product.commodity.edit')
            ->with([
                'categories' => $categories,
                'plates' => $plates,
                'topics' => $topics,
                'commodity' => $commodity,
            ]);
    }

    public function update(Request $request, $id)
    {
        $commodity = ProductCommodity::findOrFail($id);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/commodity/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $commodity->commodity_img = $filePath . $fileName;
        }
        $commodity->commodity_name = $request->input('commodity_name');
        $commodity->commodity_number = $request->input('commodity_number');
        $commodity->commodity_original_price = $request->input('commodity_original_price');
        $commodity->commodity_current_price = $request->input('commodity_current_price');
        $commodity->commodity_stock_number = $request->input('commodity_stock_number');
        $commodity->commodity_sold_number = $request->input('commodity_sold_number');
        $commodity->commodity_detail_info = $request->input('commodity_detail_info');
        $base_info = $request->input('commodity_base_info');
        $placeholder = "======For Example======\n尺寸：14*14；\n颜色：白色；\n产地：中国。";
        if ($base_info != $placeholder) {
            $commodity->commodity_base_info = $base_info;
        }
        $commodity->commodity_disabled = $request->input('commodity_disabled');
        $commodity->commodity_sort = $request->input('commodity_sort');
        $commodity->topic_id = $request->input('topic_id');
        $commodity->plate_id = $request->input('plate_id');
        $commodity->category_id = $request->input('category_id');
        if ($commodity->save()) {
            return redirect()->to('admin/product/commodity')->withSuccess('修改商品成功！');
        } else {
            return redirect()->to('admin/product/commodity')->withError('修改商品失败！');
        }
    }

    public function destroy($id)
    {
        $commodity = ProductCommodity::findOrFail($id);
        $commodity->delete();
        return redirect()->to('admin/product/commodity')->withSuccess('删除商品成功！');
    }
}
