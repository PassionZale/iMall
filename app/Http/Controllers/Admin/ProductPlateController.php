<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use App\ProductPlate;

class ProductPlateController extends Controller
{
    public function index()
    {
        $plates = ProductPlate::paginate(10);
        return view('admin.product.plate.index')->with(['plates' => $plates]);
    }

    public function create()
    {
        return view('admin.product.plate.create');
    }

    public function store(Request $request)
    {
        $plate = new ProductPlate();
        if (!empty($request->input('plate_sort'))) {
            $plate->plate_sort = $request->input('plate_sort');
        }
        $plate->plate_title = $request->input('plate_title');
        $plate->disabled = $request->input('disabled');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/plate/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $plate->plate_img = $filePath . $fileName;
        } else {
            return redirect()->to('admin/product/plate')->withError('图片不合法！');
        }
        if ($plate->save()) {
            return redirect()->to('admin/product/plate')->withSuccess('新增板块成功！');
        } else {
            return redirect()->to('admin/product/plate')->withError('新增板块失败！');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $plate = ProductPlate::findOrFail($id);
        return view('admin.product.plate.edit')->with(['plate' => $plate]);
    }

    public function update(Request $request, $id)
    {
        $plate = ProductPlate::findOrFail($id);
        if (!empty($request->input('plate_sort'))) {
            $plate->plate_sort = $request->input('plate_sort');
        }
        $plate->plate_title = $request->input('plate_title');
        $plate->disabled = $request->input('disabled');
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $filePath = '/uploads/plate/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('file'))
                ->encode('png')
                ->resize(600, 300)
                ->save('.' . $filePath . $fileName);
            $plate->plate_img = $filePath . $fileName;
        }
        if ($plate->save()) {
            return redirect()->to('admin/product/plate')->withSuccess('修改板块成功！');
        } else {
            return redirect()->to('admin/product/plate')->withError('修改板块失败！');
        }
    }

    public function destroy($id)
    {
        $plate = ProductPlate::findOrFail($id);
        $plate->delete();
        return redirect()->to('admin/product/plate')->withSuccess('删除板块成功！');
    }
}
