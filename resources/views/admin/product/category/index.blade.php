@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">分类设置</div>
        <div class="panel-body">
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
@endsection

@section('scriptTag')
    {{--<link href="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" rel="stylesheet">--}}
    {{--<script src="//cdn.bootcss.com/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>--}}
    <script src="{{asset('js/admin/product/categoryIndex.js')}}"></script>
@endsection