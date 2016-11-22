@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">专题修改</div>
        <div class="panel-body">
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
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>
@endsection
@section('scriptTag')
<script src="{{asset('js/admin/product/plateEdit.js')}}"></script>
@endsection
