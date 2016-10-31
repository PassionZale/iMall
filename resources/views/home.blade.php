@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            You are logged in!
        </div>
    </div>

@endsection

@section('scriptTag')
    <i id="scriptTag">{{asset('js/admin/sidebar.js')}}</i>
@endsection
