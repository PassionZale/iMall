@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">新增轮播图</div>

        <div class="panel-body">
            <form action="{{url('admin/shop/banner')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>排序：</label>
                    <input name="sort" type="text" class="form-control" placeholder="值越小越靠前显示,默认为0" value="0">
                </div>
                <div class="form-group">
                    <label>标题：</label>
                    <input name="title" type="text" class="form-control" placeholder="轮播图标题，可为空">
                </div>
                <div class="form-group">
                    <label>图片：</label>
                    <input name="img_url" type="file" class="form-control">
                </div>
                <div class="form-group __hide__" id="menu-url">
                    <label>链接：</label>
                    <input name="redirect_url" type="text" class="form-control" placeholder="">
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

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/shop/bannerCreate.js')}}</i>
@endsection