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
                    <strong>轮播图</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>轮播图列表</h5>
            </div>
            <div class="ibox-content">
                <a href="{{url('admin/shop/banner/create')}}" class="btn btn-primary">
                    <i class="fa fa-btn fa-plus"></i>新增
                </a>
                @if(!empty($banners))
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>跳转连接</th>
                            <th>标题</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td>
                                    <img class="banner-img-url" alt="轮播图" src="{{$banner->img_url}}"/>
                                </td>
                                <td>
                                    {{$banner->redirect_url}}
                                </td>
                                <td>
                                    {{$banner->title}}
                                </td>
                                <td>
                                    {{$banner->sort}}
                                </td>
                                <td>
                                    {{$banner->disabled}}
                                </td>
                                <td>
                                    <a href="{{url('admin/shop/banner/'.$banner->id.'/edit')}}" class="edit-btn" title="修改">修改</a>
                                    <form action="{{url('admin/shop/banner/'.$banner->id)}}" method="post" class="del-form">
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
                    {!! $banners->links() !!}
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/shop/bannerIndex.js')}}</i>
@endsection