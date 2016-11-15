@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">修改轮播图</div>

        <div class="panel-body">
            <form action="{{url('admin/shop/banner/'.$banner->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" value="PUT" name="_method">
                <div class="form-group">
                    <label>排序：</label>
                    <input name="sort" type="text" class="form-control" placeholder="值越小越靠前显示,默认为0"
                           value="{{$banner->sort}}">
                </div>
                <div class="form-group">
                    <label>标题：</label>
                    <input name="title" type="text" class="form-control" placeholder="轮播图标题，可为空"
                           value="{{$banner->title}}">
                </div>
                <div class="form-group">
                    <label>图片：</label>
                    @if($banner->img_url)
                        <img src="{{$banner->img_url}}" class="img-thumbnail">
                        <input id="file" name="file" type="file" class="form-control hidden">
                    @else
                        <input name="file" type="file" class="form-control" required>
                    @endif
                </div>
                <div class="form-group">
                    <label>链接：</label>
                    <input name="redirect_url" type="text" class="form-control" value="{{$banner->redirect_url}}">
                </div>
                <div class="form-group">
                    <label>状态：</label>
                    <label class="radio-inline">
                        <input type="radio" name="disabled" value="1" @if($banner->disabled=="显示") checked @endif> 显示
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="disabled" value="2" @if($banner->disabled=="隐藏") checked @endif> 隐藏
                    </label>
                </div>
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>
@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/shop/bannerEdit.js')}}</i>
@endsection