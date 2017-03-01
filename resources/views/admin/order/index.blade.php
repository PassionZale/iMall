@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>订单管理</h2>
            <small class="text-danger"><i>TODO:</i> 此模块暂为静态页面，数据渲染待开发。</small>
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
                                    <a href="#" class="edit-btn">详情</a>
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
@endsection

@section('scriptTag')

@endsection