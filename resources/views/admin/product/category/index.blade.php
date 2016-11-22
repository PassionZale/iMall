@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">分类设置</div>
        <div class="panel-body">
            <a href="{{url('admin/product/category/create')}}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus"></i>新增
            </a>
            <div class="row tree-wrapper">
                <div class="col-sm-3">
                    <div id="tree"></div>
                </div>
                <div class="col-sm-9">
                    <p>分类列表</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <link href="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="{{asset('js/admin/product/categoryIndex.js')}}"></script>
@endsection