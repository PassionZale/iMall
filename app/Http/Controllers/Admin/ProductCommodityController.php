<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductCommodity;
use Image;

class ProductCommodityController extends Controller
{
    public function index()
    {
        $commodities = ProductCommodity::paginate(10);
        return view('admin.product.commodity.index')->with(['commodities'=>$commodities]);
    }

    public function create()
    {
        //
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
