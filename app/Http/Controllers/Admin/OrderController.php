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
            ->first();
        $detail_html = '<td colspan="3">';
        foreach ($orderInfo->details as $detail) {
            $detail_html .= '<img class="commodity-img-url" src="' . $detail->commodity_img . '"/>';
            $detail_html .= '【'.$detail->commodity_number . '】'. $detail->commodity_name . '【'. $detail->buy_number.'件】';
            $detail_html .= '<br><br>';
        }
        $detail_html .= '</td>';

        print $html = <<<EOF
<tr>
    <th>订单号：</th>
    <td class="modal-data-1">{$orderInfo->order_number}</td>
    <th>下单时间：</th>
    <td class="modal-data-2">{$orderInfo->created_at}</td>
</tr>
<tr>
    <th>订单总价：</th>
    <td class="modal-data-3">&yen; {$orderInfo->order_amount}</td>
    <th>商品总价：</th>
    <td class="modal-data-4">&yen; {$orderInfo->commodity_amount}</td>
</tr>
<tr>
    <th>支付状态：</th>
    <td class="modal-data-5">{$orderInfo->pay_status}</td>
    <th>配送状态：</th>
    <td class="modal-data-6">{$orderInfo->ship_status}</td>
</tr>
<tr>
    <th>物流公司：</th>
    <td class="modal-data-7">{$orderInfo->ship_name}</td>
    <th>物流单号：</th>
    <td class="modal-data-8">{$orderInfo->ship_number}</td>
</tr>
<tr>
    <th>收货人姓名：</th>
    <td class="modal-data-9">{$orderInfo->name}</td>
    <th>收货人电话：</th>
    <td class="modal-data-2">{$orderInfo->phone}</td>
</tr>
<tr>
    <th>收货人地址：</th>
    <td class="modal-data-2" colspan="3">{$orderInfo->province} {$orderInfo->city} {$orderInfo->district} {$orderInfo->address}</td>
</tr>
<tr>
    <th>购物清单：</th>
    {$detail_html}
</tr>
EOF;
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
