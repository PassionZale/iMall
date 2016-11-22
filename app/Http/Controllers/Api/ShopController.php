<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ShopBanner;
use App\ProductTopic;

class ShopController extends Controller
{
    public function getBanner()
    {
        $banners = ShopBanner::where('disabled', '=', '显示')
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($banners);
    }

    public function getTopic()
    {
        $topics = ProductTopic::where('disabled', '=', '显示')
            ->orderBy('topic_sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return response()->json($topics);
    }

}
