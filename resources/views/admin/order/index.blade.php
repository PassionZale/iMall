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
                <a href="#" class="btn btn-primary">
                    待支付
                </a>
                <a href="#" class="btn btn-primary">
                    待发货
                </a>
                <a href="#" class="btn btn-primary">
                    已发货
                </a>
                <a href="#" class="btn btn-primary">
                    已完成
                </a>
                {{--@if(!empty($categories))--}}
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
                            <th>下单时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--@foreach($categories as $category)--}}

                        {{--@endforeach--}}
                        </tbody>
                    </table>
                    <nav class="text-center">
                        {{--{!! $categories->links() !!}--}}
                    </nav>
                {{--@endif--}}
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')

@endsection