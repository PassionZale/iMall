@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">商品设置</div>
        <div class="panel-body">
            <a href="{{url('admin/product/commodity/create')}}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus"></i>新增
            </a>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src=""></script>
@endsection