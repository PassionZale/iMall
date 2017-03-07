@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>订单管理</h2>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>订单列表</h5>
            </div>
            <div class="ibox-content">
                <a href="{{url('admin/order?status=unpay')}}"
                   class="btn {{ $status == 'unpay' ? 'btn-primary' : 'btn-default' }} ">
                    待支付
                </a>
                <a href="{{url('admin/order?status=unship')}}"
                   class="btn {{ $status == 'unship' ? 'btn-primary' : 'btn-default' }}">
                    待发货
                </a>
                <a href="{{url('admin/order?status=shiped')}}"
                   class="btn {{ $status == 'shiped' ? 'btn-primary' : 'btn-default' }}">
                    已发货
                </a>
                <a href="{{url('admin/order?status=received')}}"
                   class="btn {{ $status == 'received' ? 'btn-primary' : 'btn-default' }}">
                    已完成
                </a>
                {{--<a href="{{url('admin/order?status=closed')}}" class="btn {{ $status == 'closed' ? 'btn-primary' : 'btn-default' }}">--}}
                {{--已关闭--}}
                {{--</a>--}}
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>头像</th>
                        <th>订单号</th>
                        <th>支付状态</th>
                        <th>订单总价</th>
                        <th>配送状态</th>
                        <th>收货人姓名</th>
                        <th>收货人电话</th>
                        <th>收货人地址</th>
                        <th>下单时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($data->items()))
                        @foreach($data->items() as $order)
                            <tr>
                                <td><img class="head-img-url" src="{{$order->follow->headimgurl}}"/></td>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->pay_status}}</td>
                                <td>&yen; {{$order->order_amount}}</td>
                                <td>{{$order->ship_status}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->province}} {{$order->city}} {{$order->district}} {{$order->address}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <a href="javascript:;" data-order="{{$order->id}}" class="info-btn">查看</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <nav class="text-center">
                    {!! $data->appends(['status'=>$status])->render() !!}
                </nav>
            </div>
        </div>
    </div>

    <div class="modal inmodal fade" id="orderModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">关闭</span>
                    </button>
                    <h4 class="modal-title">订单详情</h4>
                </div>
                <div class="modal-body">
                    <table id="data-table" class="table table-responsive table-hover">
                        <tr>
                            <th>订单号：</th>
                            <td class="modal-data-1"></td>
                            <th>下单时间：</th>
                            <td class="modal-data-2">${created_at}</td>
                        </tr>
                        <tr>
                            <th>订单总价：</th>
                            <td class="modal-data-3">&yen; ${order_amount}</td>
                            <th>商品总价：</th>
                            <td class="modal-data-4">&yen; ${commodity_amount}</td>
                        </tr>
                        <tr>
                            <th>支付状态：</th>
                            <td class="modal-data-5">${pay_status}</td>
                            <th>配送状态：</th>
                            <td class="modal-data-6">${ship_status}</td>
                        </tr>
                        <tr>
                            <th>物流公司：</th>
                            <td class="modal-data-7">${ship_name}</td>
                            <th>物流单号：</th>
                            <td class="modal-data-8">${ship_number}</td>
                        </tr>
                        <tr>
                            <th>收货人姓名：</th>
                            <td class="modal-data-9">${name}</td>
                            <th>收货人电话：</th>
                            <td class="modal-data-2">${phone}</td>
                        </tr>
                        <tr>
                            <th>收货人地址：</th>
                            <td class="modal-data-2" colspan="3">${province} ${city} ${district} ${address}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">确定</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/order/orderInfo.js')}}"></script>
@endsection