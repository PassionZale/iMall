@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">菜单列表</div>

        <div class="panel-body">
            <a href="{{url('admin/wechat/menu/create')}}" class="btn btn-primary"><i class="fa fa-btn fa-plus"></i>新增</a>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>菜单名称</th>
                    <th>类型</th>
                    <th>关联关键词</th>
                    <th>关联链接</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>aa</td>
                    <td>cc</td>
                    <td>dd</td>
                    <td>bb</td>
                    <td>dd</td>
                    <td>
                        <a class="edit-btn">修改</a>
                        <a class="del-btn">删除</a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>aa</td>
                    <td>cc</td>
                    <td>dd</td>
                    <td>bb</td>
                    <td>dd</td>
                    <td>
                        <a class="edit-btn">修改</a>
                        <a class="del-btn">删除</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#">«</a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </nav>
        </div>
    </div>

@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/index.js')}}</i>
@endsection
