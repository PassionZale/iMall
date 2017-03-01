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
                    <strong>板块</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>新增板块</h5>
            </div>
            <div class="ibox-content">
                <form action="{{url('admin/product/plate')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>排序：</label>
                        <input name="plate_sort" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0">
                    </div>
                    <div class="form-group">
                        <label>名称：</label>
                        <input name="plate_title" type="text" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>图片：</label>
                        <input name="file" type="file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="disabled" value="1" checked> 显示
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="disabled" value="2"> 隐藏
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection
