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
              <i class="fa fa-table"></i> User Table
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Gender</th>
                        <th>Date Of Birth</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($users as $user)
                            <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img src="{{ asset('image_profile/'. $user->profile_picture) }}" alt="gambar" style="max-height:200px; max-width:200px"></td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->dob }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <p><a href="/admin/user/{{$user->id}}/getupdate" class="btn btn-success btn-block">Edit</a></p> 
                                <form action="/admin/user/{{$user->id}}/postdelete" method="POST">
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
