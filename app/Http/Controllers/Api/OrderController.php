<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WechatAddress;
use App\ProductCommodity;
use App\WechatOrder;
use App\WechatOrderDetail;
use App\ShopConfig;
use Validator;

class OrderController extends Controller
{
    protected $follow;

    public function __construct()
    {
        $this->follow = session('wechat.oauth_user');
    }

    /**
     * 生成订单号
     * @return string
     */
    private function build_order_no()
    {
        return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    public function store(Request $request)
    {
        // TODO validator
        $order = new WechatOrder;
        $order->openid = $this->follow->id;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->province = $request->province;
        $order->city = $request->city;
        $order->district = $request->district;
        $order->address = $request->address;
        $goods = $request->commodity;
        // 查询商品基础运费设置信息
        $shop_config = ShopConfig::first();
        // 计算商品总价
        $commodity_amount = 0.00;
        foreach ($goods as $item) {
            $commodity_amount += $item['commodity_current_price'] * $item['cart_num'];
        }
        // 若不满足包邮价格，计算所需邮费
        $freight_amount = 0.00;
        if ($shop_config && $commodity_amount < $shop_config->config_free) {
            $freight_amount = $shop_config->config_freight;
        }
        // 计算订单总价
        $order_amount = $commodity_amount + $freight_amount;
        $order->commodity_amount = $commodity_amount;
        $order->freight_amount = $freight_amount;
        $order->order_amount = $order_amount;
        $order->order_number = $this->build_order_no();
        // 记录订单表，并插入订单明细表
        if ($order->save()) {
            $detail = new WechatOrderDetail;
            $detail->order_id = $order->id;
            $detail->openid = $this->follow->id;
            foreach ($goods as $item) {
                $detail->commodity_id = $item['id'];
                $detail->commodity_name = $item['commodity_name'];
                $detail->commodity_img = $item['commodity_img'];
                $detail->commodity_number = $item['commodity_number'];
                $detail->commodity_original_price = $item['commodity_original_price'];
                $detail->commodity_current_price = $item['commodity_current_price'];
                $detail->buy_number = $item['cart_num'];
                $detail->save();
            }
            return response()->json([
                'code' => 0,
                'message' => $order->id
            ]);
        } else {
            return response()->json([
                'code' => -1,
                'message' => '订单创建失败！'
            ]);
        }
    }

    public function show($id)
    {
        $order = WechatOrder::find($id);
        if ($order) {
            return response()->json([
                'code' => 0,
                'message' => $order
            ]);
        }else{
            return response()->json([
                'code' => -1,
                'message' => '该订单不存在！'
            ]);
        }
    }
}
