<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\WechatOrder;
use App\WechatOrderDetail;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        // unpay unship shiped received ''closed''
        $status = empty($request->input('status')) ? 'unship' : $request->input('status');
        // 封装查询条件
        $data = WechatOrder::with('follow')
            ->where(function ($query) use ($status) {
                switch ($status) {
                    case 'unpay':
                        $query->where('pay_status', '=', '未支付');
                        break;
                    case 'shiped':
                        $query->where('pay_status', '=', '已支付')
                            ->where('ship_status', '=', '已发货');
                        break;
                    case 'received':
                        $query->where('pay_status', '=', '已支付')
                            ->where('ship_status', '=', '已收货');
                        break;
                    case 'closed':
                        // TODO 暂未实现关闭订单功能
                        break;
                    default:
                        $query->where('pay_status', '=', '已支付')
                            ->where('ship_status', '=', '未发货');
                        break;
                }
            })->paginate(5);

        return view('admin.order.index')->with([
            'data' => $data,
            'status' => $status,
        ]);
    }

    public function show($id)
    {
        $orderInfo = WechatOrder:: where('id', '=', $id)
            ->with('follow')
            ->with('details')
            ->get();
        return response()->json([
            'orderInfo' => $orderInfo
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
