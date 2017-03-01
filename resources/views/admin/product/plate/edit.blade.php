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
                <h5>板块修改</h5>
            </div>
            <div class="ibox-content">
                <form action="{{url('admin/product/plate/' . $plate->id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" value="PUT" name="_method">
                    <div class="form-group">
                        <label>排序：</label>
                        <input name="plate_sort" value="{{$plate->plate_sort}}" type="number" class="form-control"
                               placeholder="值越小越靠前显示,默认为0">
                    </div>
                    <div class="form-group">
                        <label>名称：</label>
                        <input name="plate_title" value="{{$plate->plate_title}}" type="text" class="form-control"
                               placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>图片：</label>
                        @if($plate->plate_img)
                            <img src="{{$plate->plate_img}}" class="img-thumbnail">
                            <input id="file" name="file" type="file" class="form-control hidden">
                        @else
                            <input name="file" type="file" class="form-control" required>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="disabled" value="1" @if($plate->disabled=="显示") checked @endif> 显示
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="disabled" value="2" @if($plate->disabled=="隐藏") checked @endif> 隐藏
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scriptTag')
<script src="{{asset('js/admin/product/plateEdit.js')}}"></script>
@endsection
