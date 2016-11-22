@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">专题设置</div>
        <div class="panel-body">
            <a href="{{url('admin/product/topic/create')}}" class="btn btn-primary">
                <i class="fa fa-btn fa-plus"></i>新增
            </a>
            @if(!empty($topics))
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
                    @foreach($topics as $topic)
                        <tr>
                            <td>
                                <img class="topic-img-url" src="{{$topic->topic_img}}"/>
                            </td>
                            <td>
                                {{$topic->topic_title}}
                            </td>
                            <td>
                                {{$topic->topic_sort}}
                            </td>
                            <td>
                                {{$topic->disabled}}
                            </td>
                            <td>
                                <a href="{{url('admin/product/topic/'.$topic->id.'/edit')}}" class="edit-btn" title="修改">修改</a>
                                <form action="{{url('admin/product/topic/'.$topic->id)}}" method="post" class="del-form">
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
                {!! $topics->links() !!}
            </nav>
        </div>
    </div>
@endsection
