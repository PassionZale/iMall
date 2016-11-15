@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">轮播图列表</div>

        <div class="panel-body">
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
                                <img class="headimgurl" alt="轮播图" src="{{$banner->img_url}}"/>
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
@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/shop/bannerIndex.js')}}</i>
@endsection