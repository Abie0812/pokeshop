@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Welcome to <b>Pokeshop</b></div>
                <div class="panel-body">
                    <img class="img-responsive img-rounded" src="{{ asset('image_home/'. 'background_home.png') }}" alt="gambar" style="max-height:1000px; max-width:1020px">
                    <br>
                    <a class="btn btn-success btn-block" href="{{ url('/login') }}"><i class="fa fa-key"></i> Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
