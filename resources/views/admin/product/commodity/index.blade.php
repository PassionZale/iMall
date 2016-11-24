@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">商品设置</div>
        <div class="panel-body">
            <a href="{{url('admin/product/commodity/create')}}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus"></i>新增
            </a>
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
                                <th>排序</th>
                                <th>类型</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/product/commodityIndex.js')}}"></script>
@endsection