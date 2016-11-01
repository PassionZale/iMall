@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">基本信息</div>

        <div class="panel-body">
            基本信息！
        </div>
    </div>

@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/index.js')}}</i>
@endsection
