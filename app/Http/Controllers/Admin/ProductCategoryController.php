<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use App\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::paginate(6);
        return view('admin.product.category.index')->with(['categories' => $categories]);
    }

    public function treeData()
    {
        $data = array();
        $praentCategories = ProductCategory::where('parent_id', '=', 0)
            ->orderBy('category_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        foreach ($praentCategories as $key => $item) {
            $data[$key]['parent_category'] = $item;
            $data[$key]['sub_categories'] = ProductCategory::where('parent_id', '=', $item->id)
                ->orderBy('category_sort', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        }
        return response()->json($data);
    }

    public function create()
    {
        $parentCategories = ProductCategory::where('parent_id', '=', '0')->get();
        return view('admin.product.category.create')->with(['parentCategories' => $parentCategories]);
    }

    public function store(Request $request)
    {
        $category = new ProductCategory();
        $category->category_sort = $request->input('category_sort');
        $category->category_name = $request->input('category_name');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/category/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(150, 150)
                ->save('.' . $filePath . $fileName);
            $category->category_img = $filePath . $fileName;
        }
        $type = $request->input('type');
        $parent_id = $request->input('parent_id');
        if ($type == 2 && $parent_id != '') {
            $category->type = 2;
            $category->parent_id = $parent_id;
        } else {
            $category->type = 1;
        }
        if ($category->save()) {
            return redirect()->to('admin/product/category')->withSuccess('新增分类成功！');
        } else {
            return redirect()->to('admin/product/category')->withError('新增分类失败！');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $parentCategories = ProductCategory::where('parent_id', '=', '0')->get();
        return view('admin/product/category/edit')
            ->with(['category' => $category, 'parentCategories' => $parentCategories]);
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->category_sort = $request->input('category_sort');
        $category->category_name = $request->input('category_name');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/category/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(150, 150)
                ->save('.' . $filePath . $fileName);
            $category->category_img = $filePath . $fileName;
        }
        $type = $request->input('type');
        $parent_id = $request->input('parent_id');
        if ($type == 2 && $parent_id != '') {
            $category->type = 2;
            $category->parent_id = $parent_id;
        } else {
            $category->type = 1;
        }
        if ($category->save()) {
            return redirect()->to('admin/product/category')->withSuccess('修改分类成功！');
        } else {
            return redirect()->to('admin/product/category')->withError('修改分类失败！');
        }
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return redirect()->to('admin/product/category')->withSuccess('删除分类成功！');
    }
}
