@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>商品管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">商品管理</a>
                </li>
                <li class="active">
                    <strong>商品</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>商品设置</h5>
            </div>
            <div class="ibox-content">
                <a href="{{url('admin/product/commodity/create')}}" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i>新增
                </a>
                <a href="{{url('admin/product/commodity')}}" class="btn btn-warning">全部商品</a>
                <div class="row tree-container">
                    <div class="col-md-2">
                        <div id="tree"></div>
                    </div>
                    <div class="col-md-10">
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th>图片</th>
                                <th>名称</th>
                                <th>价格</th>
                                <th>库存</th>
                                <th>已售</th>
                                <th>状态</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($commodities as $commodity)
                                <tr>
                                    <td>
                                        <img class="commodity-img-url" src="{{$commodity->commodity_img}}">
                                    </td>
                                    <td>{{$commodity->commodity_name}}</td>
                                    <td>&yen;{{$commodity->commodity_current_price}}</td>
                                    <td>{{$commodity->commodity_stock_number}}</td>
                                    <td>{{$commodity->commodity_sold_number}}</td>
                                    <td>{{$commodity->commodity_disabled}}</td>
                                    <td>{{$commodity->commodity_sort}}</td>
                                    <td>
                                        <a href="{{url('admin/product/commodity/'.$commodity->id.'/edit')}}" class="edit-btn" title="修改">修改</a>
                                        <form action="{{url('admin/product/commodity/'.$commodity->id)}}" method="post" class="del-form">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{csrf_field()}}
                                            <button title="删除" type="submit" class="del-btn">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <link href="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="{{asset('js/admin/product/commodityIndex.js')}}"></script>
@endsection