@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">基本信息</div>

        <div class="panel-body">
        @if(empty($info))
            <!--新增表单-->
                <form role="form" action="{{url('admin/wechat/info')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">名称：</label>
                        <input name="wechat_name" value="{{old('wechat_name')}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">微信号：</label>
                        <input name="wechat_account" value="{{old('wechat_account')}}" type="text" class="form-control"
                               id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">原始ID：</label>
                        <input name="wechat_original_account" value="{{old('wechat_original_account')}}" type="text"
                               class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">appId：</label>
                        <input name="app_id" value="{{old('app_id')}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">appSecret：</label>
                        <input name="app_secret" value="{{old('app_secret')}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">密钥（安全模式必填）：</label>
                        <input name="encodingaeskey" value="{{old('encodingaeskey')}}" type="text" class="form-control"
                               id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Token：</label>
                        <input name="token" value="{{old('token')}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Url：</label>
                        <input disabled type="text" class="form-control" id="" placeholder="信息录入后自动生成">
                    </div>
                    <button type="submit" class="btn btn-default">保存</button>
                </form>
        @else
            <!--修改表单-->
                <form role="form" action="{{url('admin/wechat/info/'.$info->id)}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" value="PUT" name="_method">
                    <div class="form-group">
                        <label for="">名称：</label>
                        <input name="wechat_name" value="{{$info->wechat_name}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">微信号：</label>
                        <input name="wechat_account" value="{{$info->wechat_account}}" type="text" class="form-control"
                               id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">原始ID：</label>
                        <input name="wechat_original_account" value="{{$info->wechat_original_account}}" type="text"
                               class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">appId：</label>
                        <input name="app_id" value="{{$info->app_id}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">appSecret：</label>
                        <input name="app_secret" value="{{$info->app_secret}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">密钥（安全模式必填）：</label>
                        <input name="encodingaeskey" value="{{$info->encodingaeskey}}" type="text" class="form-control"
                               id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Token：</label>
                        <input name="token" value="{{$info->token}}" type="text" class="form-control" id=""
                               placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Url：</label>
                        <input disabled value="{{$info->url}}" type="text" class="form-control" id=""
                               placeholder="信息录入后自动生成">
                    </div>
                    <button type="submit" class="btn btn-default">确定</button>
                </form>
            @endif
        </div>
    </div>

@endsection

