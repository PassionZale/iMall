@extends('layouts.app')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>店铺管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">店铺管理</a>
                </li>
                <li class="active">
                    <strong>商铺配置</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>修改轮播图</h5>
            </div>
            <div class="ibox-content">
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
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/shop/bannerEdit.js')}}"></script>
@endsection