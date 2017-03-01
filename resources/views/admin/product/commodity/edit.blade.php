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
                    <strong>商品</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>商品修改</h5>
            </div>
            <div class="ibox-content">
                <form class="form-small-text" action="{{url('admin/product/commodity/'.$commodity->id)}}" method="post"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" value="PUT" name="_method">
                    <div class="form-group">
                        <label>排序：</label>
                        <input name="commodity_sort" value="{{$commodity->commodity_sort}}" type="number"
                               class="form-control" placeholder="值越小越靠前显示,默认为0">
                    </div>
                    <div class="form-group">
                        <label>名称：</label>
                        <input name="commodity_name" value="{{$commodity->commodity_name}}" type="text" class="form-control"
                               placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>图片：</label>
                        @if($commodity->commodity_img)
                            <img src="{{$commodity->commodity_img}}" class="img-thumbnail">
                            <input id="file" name="file" type="file" class="form-control hidden">
                        @else
                            <input name="file" type="file" class="form-control">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>编号：</label>
                        <input name="commodity_number" value="{{$commodity->commodity_number}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>所属专题：</label>
                        <select class="form-control" name="topic_id">
                            <option value="0">无</option>
                            @foreach($topics as $topic)
                                <option @if($topic->id == $commodity->topic_id) selected @endif value="{{$topic->id}}">{{$topic->topic_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>所属板块：</label>
                        <select class="form-control" name="plate_id">
                            <option value="0">无</option>
                            @foreach($plates as $plate)
                                <option @if($plate->id == $commodity->plate_id) selected @endif value="{{$plate->id}}">{{$plate->plate_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>所属分类：</label>
                        <select class="form-control" name="category_id">
                            <option value="0">无</option>
                            @foreach($categories as $category)
                                <option @if($category->id == $commodity->category_id) selected @endif value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>商品简介：</label>
                        <textarea rows="4" cols="80" name="commodity_base_info" class="form-control">{{$commodity->commodity_base_info}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>商品详情：</label>
                        <textarea id="editor" name="commodity_detail_info" class="form-control">{{$commodity->commodity_detail_info}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>原价：</label>
                        <input name="commodity_original_price" value="{{$commodity->commodity_original_price}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>现价：</label>
                        <input name="commodity_current_price" value="{{$commodity->commodity_current_price}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>库存：</label>
                        <input name="commodity_stock_number" value="{{$commodity->commodity_stock_number}}" type="text"
                               class="form-control" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>销量：</label>
                        <input name="commodity_sold_number" value="{{$commodity->commodity_sold_number}}" type="text"
                               class="form-control" placeholder="可选，默认为0">
                    </div>
                    <div class="form-group">
                        <label>状态：</label>
                        <label class="radio-inline">
                            <input type="radio" name="commodity_disabled" value="1" @if($commodity->commodity_disabled == '已上架') checked @endif> 上架
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="commodity_disabled" value="2" @if($commodity->commodity_disabled == '已下架') checked @endif> 下架
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <link href="//cdn.bootcss.com/wangeditor/2.1.20/css/wangEditor.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/wangeditor/2.1.20/js/wangEditor.min.js"></script>
    <script src="{{asset('js/admin/product/commodityEdit.js')}}"></script>
@endsection