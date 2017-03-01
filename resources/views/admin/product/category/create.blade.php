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
                    <strong>分类</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>新增分类</h5>
            </div>
            <div class="ibox-content">
                <form action="{{url('admin/product/category')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>排序：</label>
                        <input name="category_sort" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0">
                    </div>
                    <div class="form-group">
                        <label>名称：</label>
                        <input name="category_name" type="text" class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>图片：</label>
                        <input name="file" type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>类型：</label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="1" checked> 一级分类
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="2"> 二级分类
                        </label>
                    </div>
                    <div class="form-group hidden" id="parentWrapper">
                        <label>选择上级分类：</label>
                        @if(!count($parentCategories))
                            <p class="text-warning">创建二级分类，请先新建至少一个一级分类</p>
                        @endif
                        <select class="form-control" name="parent_id">
                            @foreach($parentCategories as $item)
                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/product/categoryCreate.js')}}"></script>
@endsection