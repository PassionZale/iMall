@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">商铺配置</div>

        <div class="panel-body">
        @if(empty($configs))
            <!--新增表单-->
                <form role="form" action="{{url('admin/shop/config')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">名称：</label>
                        <input name="config_name" value="{{old('config_name')}}" type="text" class="form-control" placeholder="商城名称">
                    </div>
                    <div class="form-group">
                        <label for="">基础运费：</label>
                        <input name="config_freight" value="{{old('config_freight')}}" type="text" class="form-control" placeholder="基础运费，默认0.00元">
                    </div>
                    <div class="form-group">
                        <label for="">包邮最低消费额：</label>
                        <input name="config_free" value="{{old('config_free')}}" type="text" class="form-control" placeholder="若为空，则不包邮">
                    </div>
                    <button type="submit" class="btn btn-default">保存</button>
                </form>
        @else
            <!--修改表单-->
                <form role="form" action="{{url('admin/shop/config/'.$configs->id)}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="PUT" name="_method">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">名称：</label>
                        <input name="config_name" value="{{$configs->config_name}}" type="text" class="form-control" placeholder="商城名称">
                    </div>
                    <div class="form-group">
                        <label for="">基础运费：</label>
                        <input name="config_freight" value="{{$configs->config_freight}}" type="text" class="form-control" placeholder="基础运费，默认0.00元">
                    </div>
                    <div class="form-group">
                        <label for="">包邮最低消费额：</label>
                        <input name="config_free" value="{{$configs->config_free}}" type="text" class="form-control" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-default">确定</button>
                </form>
            @endif
        </div>
    </div>

@endsection

