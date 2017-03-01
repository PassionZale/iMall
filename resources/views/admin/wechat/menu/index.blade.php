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
                    <strong>菜单设置</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>菜单列表</h5>
            </div>
            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    <div class="col-lg-12">
                        <a href="{{url('admin/wechat/menu/create')}}" class="btn btn-primary">
                            <i class="fa fa-btn fa-plus"></i> 新增
                        </a>
                        <button id="push-menu-btn" class="btn btn-warning" type="button">
                            <i class="fa fa-btn fa-send"></i> 生成菜单
                        </button>
                        <form id="push-menu-form" class="__hide__" method="post" action="{{url('admin/wechat/pushMenu')}}">
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>

                @if(!empty($menus))
                    <table class="table table-responsive table-hover">
                        <thead>
                        <tr>
                            <th class="text-left">菜单名称</th>
                            <th>类型</th>
                            <th>关联关键词</th>
                            <th class="text-left limit-width">关联链接</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td class="text-left">{{$menu->name}}</td>
                                <td>
                                    @if($menu->type == 'view')
                                        跳转视图
                                    @elseif($menu->type == 'click')
                                        点击推事件
                                    @else
                                        一级菜单
                                    @endif
                                </td>
                                <td>{{$menu->key}}</td>
                                <td title="{{$menu->url}}" class="limit-width text-left fn-text-overflow">{{$menu->url}}</td>
                                <td>{{$menu->sort}}</td>
                                <td>
                                    <a href="{{url('admin/wechat/menu/'.$menu->id.'/edit')}}" class="edit-btn">修改</a>
                                    <form action="{{url('admin/wechat/menu/'.$menu->id)}}" method="post" class="del-form">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{csrf_field()}}
                                        <button title="若为一级菜单，将会同时删除所属全部二级菜单" type="submit" class="del-btn">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/wechat/menuIndex.js')}}"></script>
@endsection
