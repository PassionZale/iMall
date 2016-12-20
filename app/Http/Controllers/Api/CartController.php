<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProductCommodity;
use App\WechatCart;
use Validator;

class CartController extends Controller
{
    protected $follow;

    public function __construct()
    {
        $this->follow = session('wechat.oauth_user');
    }

    public function index()
    {
        $openid = $this->follow->id;
        $cart = WechatCart::where('openid', '=', $openid)->get();
        return response()->json([
            'code' => 0,
            'message' => $cart,
        ]);
    }

    public function calculateTotal()
    {
        $cartCount = WechatCart::where('openid', '=', $this->follow->id)->count();
        return response()->json([
            'code' => 0,
            'message' => $cartCount,
        ]);
    }

    public function store(Request $request)
    {
        $openid = $this->follow->id;
        $rules = [
            'commodity_id' => 'required',
            'commodity_num' => 'required|integer|min:1',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'code' => -1,
                'message' => '操作异常',
            ]);
        } else {
            $cart = new WechatCart();
            $cart->openid = $openid;
            $cart->commodity_id = $request->commodity_id;
            $cart->commodity_num = $request->commodity_num;
            if ($cart->save()) {
                return response()->json([
                    'code' => 0,
                    'message' => '操作成功',
                ]);
            } else {
                return response()->json([
                    'code' => -1,
                    'message' => '操作失败',
                ]);
            }
        }
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
