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
                <h5>板块设置</h5>
            </div>
            <div class="ibox-content">
                <a href="{{url('admin/product/plate/create')}}" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i>新增
                </a>
                @if(!empty($plates))
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>标题</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plates as $plate)
                            <tr>
                                <td>
                                    <img class="plate-img-url" src="{{$plate->plate_img}}"/>
                                </td>
                                <td>
                                    {{$plate->plate_title}}
                                </td>
                                <td>
                                    {{$plate->plate_sort}}
                                </td>
                                <td>
                                    {{$plate->disabled}}
                                </td>
                                <td>
                                    <a href="{{url('admin/product/plate/'.$plate->id.'/edit')}}" class="edit-btn" title="修改">修改</a>
                                    <form action="{{url('admin/product/plate/'.$plate->id)}}" method="post" class="del-form">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                        <button title="删除" type="submit" class="del-btn">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <nav class="text-center">
                    {!! $plates->links() !!}
                </nav>
            </div>
        </div>
    </div>
@endsection
