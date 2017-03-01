@extends('layouts.app')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>公众号管理</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">公众号管理</a>
                </li>
                <li class="active">
                    <strong>粉丝列表</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>粉丝列表</h5>
            </div>
            <div class="ibox-content">
                @if(!empty($follows))
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th>头像</th>
                            <th>昵称</th>
                            <th>性别</th>
                            <th>所在地</th>
                            <th>状态</th>
                            <th>关注时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($follows as $follow)
                            <tr>
                                <td>
                                    <img class="head-img-url" alt="{{$follow->nickname}}" src="{{$follow->headimgurl}}"/>
                                </td>
                                <td>{{$follow->nickname}}</td>
                                <td>{{$follow->sex}}</td>
                                <td>{{$follow->country}} {{$follow->province}} {{$follow->city}}</td>
                                <td>{{$follow->is_subscribed}}</td>
                                <td>{{$follow->created_at}}</td>
                                <td>
                                    <form method="POST" action="{{url('admin/wechat/refresh')}}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">
                                        <input name="openid" value="{{$follow->openid}}" type="hidden">
                                        <button type="submit" class="btn btn-primary" title="更新粉丝信息">刷新</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <nav class="text-center">
                    {!! $follows->links() !!}
                </nav>
            </div>
        </div>
    </div>

@endsection

