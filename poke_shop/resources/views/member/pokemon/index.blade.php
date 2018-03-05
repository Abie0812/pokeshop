@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">
                <form action="/pokemon" method="GET" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input name="search" type="text" class="form-control" placeholder="Search Pokemon">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>            
                   
                </form>          
            </div>            
    </div>
    <div class="row">

        {{--  <div class="row">
            <div class="col-md-12">
                <h4>Filter Elements: </h4>
                <br>
                @foreach($elements as $element)
                    <a class="alert alert-success" href="/pokemon/filter/{{ $element->name }}">{{ $element->name }}</a> |
                @endforeach
            </div>        
        </div>  --}}
        <br>
        
        <h1 class="text-center">Pokemon Lists:</h1>
        @foreach($pokemons as $pokemon)
            <div class="col-md-4">
                <div class="thumbnail">
                    <div class="caption text-center"><h3>{{ $pokemon->name }}</h3></div>
                    <hr>
                    <img src="{{ asset('image_pokemon/'.$pokemon->image_path) }}" alt="gambar" style="max-height:200px; max-width:200px">
                    <br>
                    <a href="/pokemon/{{ $pokemon->slug }}" class="btn btn-info btn-block"><i class="fa fa-play"></i> Detail</a>
                </div>
            </div>
        @endforeach
    
    </div>
</div>
@endsection
