@extends('layouts.app')

@section('content')
<div class="container">

@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>    
    </div>
@endif

<form action="/pokemon/comment/{{ $comment->id }}" method="POST">
    <div class="form-group">
        <label for="description">Isi Komentar</label>
        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Masukkan subject">{{ (old('description')) ? old('description') : $comment->description }}</textarea>
    </div>
    {{ csrf_field() }}
    <div class="form-group">
        <input type="hidden" name="_method" value="PUT">
        <input name="submit" class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>
</div>


@endsection
