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
                <h5>分类设置</h5>
            </div>
            <div class="ibox-content">
                <a href="{{url('admin/product/category/create')}}" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i>新增
                </a>
                @if(!empty($categories))
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>名称</th>
                            <th>排序</th>
                            <th>类型</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <img class="category-img-url" src="{{$category->category_img}}"/>
                                </td>
                                <td>
                                    {{$category->category_name}}
                                </td>

                                <td>
                                    {{$category->category_sort}}
                                </td>
                                <td>
                                    {{$category->type}}
                                </td>
                                <td>
                                    <a href="{{url('admin/product/category/'.$category->id.'/edit')}}" class="edit-btn" title="修改">修改</a>
                                    <form action="{{url('admin/product/category/'.$category->id)}}" method="post" class="del-form">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                        <button title="删除" type="submit" class="del-btn">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav class="text-center">
                        {!! $categories->links() !!}
                    </nav>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/product/categoryIndex.js')}}"></script>
@endsection