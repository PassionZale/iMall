@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">新增菜单</div>

        <div class="panel-body">
            <form action="{{url('admin/wechat/menu')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>菜单排序：</label>
                    <input name="sort" type="number" class="form-control" placeholder="值越小越靠前显示,默认为0" autofocus>
                </div>
                <div class="form-group">
                    <label>一级菜单：</label>
                    <select name="parent_button" class="form-control">
                        <option value="0" selected>无</option>
                        @if(!empty($parent_menu))
                            @foreach($parent_menu as $menu)
                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>菜单名称：</label>
                    <input name="name" type="text" class="form-control" placeholder="菜单名称必填" required>
                </div>
                <div class="form-group">
                    <label>菜单类型：</label>
                    <select name="type" class="form-control" id="menu-type-select">
                        <option value="1">跳转视图</option>
                        <option value="2">点击推事件</option>
                        <option value="3" selected>无事件的一级菜单</option>
                    </select>
                </div>
                <div class="form-group __hide__" id="menu-url">
                    <label>关联链接：</label>
                    <input name="url" type="text" class="form-control" placeholder="跳转视图菜单必填">
                </div>
                <div class="form-group __hide__" id="menu-key">
                    <label>关联关键词：</label>
                    <input name="key" type="text" class="form-control" placeholder="点击推时间菜单必填">
                </div>
                <button type="submit" class="btn btn-default">保存</button>
            </form>
        </div>
    </div>

@endsection

@section('scriptTag')
    <script src="{{asset('js/admin/wechat/menuCreate.js')}}"></script>
@endsection
