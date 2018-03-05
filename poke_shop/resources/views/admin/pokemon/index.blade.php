@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        @if(session('msg-success'))
            <div class="alert alert-success">
                <p>{{ session('msg-success') }}</p>
            </div>
        @endif

        @if(session('msg-delete'))
            <div class="alert alert-danger">
                <p>{{ session('msg-delete') }}</p>
            </div>
        @endif
    </div>
    <br>
    <div class="row">
        <form class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
          </div>
        </form>
    </div>
    <br>
    <div class="row">        
        <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Pokemons Table
              <a class="btn btn-success" href="{{ url('/admin/pokemon/getinsert') }}">Create</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pokemon Name</th>
                        <th>Image</th>
                        <th>Gender</th>
                        <th>Element</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($pokemons as $pokemon)
                            <tr>
                            <td>{{ $pokemon->id }}</td>
                            <td>{{ $pokemon->name }}</td>
                            <td><img src="{{ asset('image_pokemon/'. $pokemon->image_path) }}" alt="gambar" style="max-height:200px; max-width:200px"></td>
                            <td>{{ $pokemon->gender }}</td>
                            <td>{{ $pokemon->element->name }}</td>
                            <td>{{ $pokemon->description }}</td>
                            <td>${{ $pokemon->price }}</td>
                            <td>
                                <p><a href="/admin/pokemon/{{$pokemon->id}}/getupdate" class="btn btn-success btn-block">Edit</a></p> 
                                <form action="/admin/pokemon/{{$pokemon->id}}/postdelete" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                </form>   
                            </td>
                            </tr>
                        @endforeach
                  </tbody>
                    
                </table>
                <div class="pagination">
                    {{--  {!! $pokemons->appends(Request::input())->links() !!}  --}}
                </div>
                
              </div>
            </div>
            <div class="card-footer small text-muted">
              
            </div>
          </div>

        {{--  {{ $elements->links() }}  --}}
    </div>
</div>
@endsection
