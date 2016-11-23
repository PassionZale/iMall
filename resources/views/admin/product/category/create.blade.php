@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">分类设置</div>
        <div class="panel-body">
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
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/product/categoryCreate.js')}}"></script>
@endsection