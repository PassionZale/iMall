@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">粉丝列表</div>

        <div class="panel-body">
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($follows as $follow)
                        <tr>
                            <td>
                                <img class="headimgurl" alt="{{$follow->nickname}}" src="{{$follow->headimgurl}}"/>
                            </td>
                            <td>{{$follow->nickname}}</td>
                            <td>{{$follow->sex}}</td>
                            <td>{{$follow->country}} {{$follow->province}} {{$follow->city}}</td>
                            <td>{{$follow->is_subscribed}}</td>
                            <td>{{$follow->created_at}}</td>
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

@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/wechat/menuIndex.js')}}</i>
@endsection
