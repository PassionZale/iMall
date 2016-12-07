<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ShopBanner;
use App\ProductTopic;
use App\ProductPlate;
use App\ProductCategory;
use App\ProductCommodity;

class ShopController extends Controller
{
    public function getBanners()
    {
        $banners = ShopBanner::where('disabled', '=', '显示')
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($banners);
    }

    public function getTopics()
    {
        $topics = ProductTopic::where('disabled', '=', '显示')
            ->orderBy('topic_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($topics);
    }

    public function getPlates()
    {
        $topics = ProductPlate::where('disabled', '=', '显示')
            ->orderBy('plate_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($topics);
    }

    public function getCategories()
    {
        $parentCategories = ProductCategory::where('parent_id', '=', '0')
            ->orderBy('category_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        $categories = array();
        foreach ($parentCategories as $key => $parent) {
            $categories[$key]['parent_category'] = $parent;
            $categories[$key]['sub_categories'] = ProductCategory::where('parent_id', '=', $parent->id)
                ->orderBy('category_sort', 'asc')
                ->orderBy('id', 'asc')
                ->get();
        }
        return response()->json($categories);
    }

    public function getCommodityByTopic(Request $request)
    {
        $id = $request->input('topic_id');
        $response = [];
        $topic = ProductTopic::find($id);
        if ($topic) {
            $response = $topic->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodityByPlate(Request $request)
    {
        $id = $request->input('plate_id');
        $response = [];
        $plate = ProductPlate::find($id);
        if ($plate) {
            $response = $plate->commodities()->get();
        }
        return response()->json($response);
    }

    public function getCommodityByCategory(Request $request)
    {
        $id = $request->input('category_id');
        $response = [];
        $category = ProductCategory::find($id);
        if ($category) {
            $response = $category->commodities()->get();
        }
        return response()->json($response);
    }

}
