@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">控制台</div>

        <div class="panel-body">
            You are logged in!
        </div>
    </div>

@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/index.js')}}</i>
@endsection
