@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="thumbnail">
                <div class="caption text-center"><h1>{{ $pokemon->name }}</h1>
                    <hr>
                    <img src="{{ asset('image_pokemon/'.$pokemon->image_path) }}" alt="gambar" style="max-height:200px; max-width:200px">
                    <p><h4>Element : {{ $pokemon->element->name }}</h4></p>
                    <p><h4>Gender  : {{ $pokemon->gender }}</h4></p>
                    <p><h4>Description: {{ $pokemon->description }}</h4></p>
                    <br>
                    <p>
                        <div class="clearfix">
                            <div class=""><b>Price: ${{ $pokemon->price }}</b></div>
                            <a href="/shop/add-to-cart/{{ $pokemon->id }}" class="btn btn-success btn-block" role="button"><i class="fa fa-shopping-cart"></i> Add To Cart</a>         
                        </div>
                    </p>
    
                </div>
            </div>
        </div>
    </div>
    
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>    
    </div>
    @endif

    @if(session('msg'))
        <div class="alert alert-success">
            <p> {{ session('msg') }} </p>
        </div>
    @endif

    @if(session('msg-edit'))
        <div class="alert alert-success">
            <p> {{ session('msg-edit') }} </p>
        </div>
    @endif

    @if(session('msg-delete'))
        <div class="alert alert-warning">
            <p> {{ session('msg-delete') }} </p>
        </div>
    @endif


    <h3>Daftar Komentar: </h3>
    <div class="row">
        @foreach($pokemon->comments as $comment)
            <div class="col-md-8">
                <p>Isi Komentar: "{{ $comment->description }}"</p>
                <p>oleh: <a href="/profile/{{$comment->user->id }}">{{ $comment->user->name }}</a> pada {{ $comment->created_at }}</p>
            </div>
            
            <div class="col-md-4">
            @if($comment->isOwner())
                <p><a href="/pokemon/comment/{{ $comment->id }}/edit" class="btn btn-success"><i class="fa fa-check"></i> Edit</a></p>
                <form action="/pokemon/comment/{{ $comment->id }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>                
                </form>            
            @endif     
            </div>
        @endforeach
    </div>

 <!-- Example Social Card -->
    {{--  @foreach($pokemon->comments as $comment)
    <div class="card mb-3">
        <a href="#">
          <img class="card-img-top img-fluid w-100" src="https://unsplash.it/700/450?image=610" alt="">
        </a>
        <div class="card-body">
            <div class="col-md-8">
                <h6 class="card-title mb-1">
                    <a href="/profile/{{$comment->user->id }}">{{ $comment->user->name }}</a>
                </h6>
                <p class="card-text">{{ $comment->description }}
                </p>          
                <div class="card-footer text-muted">
                    {{ $comment->created_at }}
                </div>
            </div>
            <div class="col-md-4">
                @if($comment->isOwner())
                    <p><a href="/pokemon/comment/{{ $comment->id }}/edit" class="btn btn-success">Edit</a></p>
                    <form action="/pokemon/comment/{{ $comment->id }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</button>                
                    </form>            
                @endif     
            </div>
        </div>     
      </div>
      @endforeach  --}}

    <br>
    <form action="/pokemon/comment/{{ $pokemon->id }}" method="POST">
        <div class="form-group">
            <label for="desc">Isi Komentar</label>
            <textarea name="desc" class="form-control" cols="30" rows="10" placeholder="Masukkan komentar">{{ old('desc') }}</textarea>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
            <input name="submit" class="btn btn-primary btn-block" type="submit" value="Kirim Komentar">
        </div>
    </form>
</div>
@endsection
