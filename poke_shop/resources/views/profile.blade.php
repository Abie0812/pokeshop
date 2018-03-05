@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center">Welcome, {{ $user->name }} </h3>
            <h4 class="text-center">{{ date('D, d M Y') }}</h4>
            <br>

            {{--  <h4 class="text-center">Daftar Quotes Anda:</h4>
            <ul class="list-group">
                @foreach($user->quotes as $quote)
                    <li class="list-group-item"><a href="/quotes/{{ $quote->slug }}">{{ $quote->title }}</a></li>
                @endforeach
            </ul>  --}}
        </div>
    </div>
</div>

@endsection
