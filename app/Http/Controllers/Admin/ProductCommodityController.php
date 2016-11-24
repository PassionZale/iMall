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
        $commodities = ProductCommodity::paginate(10);
        return view('admin.product.commodity.index')->with(['commodities' => $commodities]);
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
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
