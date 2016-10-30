@extends('layouts.app')

@section('slide')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>
@endsection