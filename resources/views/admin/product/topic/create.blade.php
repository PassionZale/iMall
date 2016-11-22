@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">专题新增</div>
        <div class="panel-body">
            <form action="{{url('admin/product/topic')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label>排序：</label>
                    <input name="topic_sort" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0">
                </div>
                <div class="form-group">
                    <label>名称：</label>
                    <input name="topic_title" type="text" class="form-control" placeholder="" required>
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
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>
@endsection
