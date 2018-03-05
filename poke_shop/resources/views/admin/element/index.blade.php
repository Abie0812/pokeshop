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
              <i class="fa fa-table"></i> Elements Table
              <a class="btn btn-success" href="{{ url('/admin/element/getinsert') }}">Create</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                        <th>Id</th>
                        <th>Element Name</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($elements as $element)
                            <tr>
                            <td>{{ $element->id }}</td>
                            <td>{{ $element->name }}</td>
                            <td><img src="{{ asset('image_element/'. $element->image_path) }}" alt="gambar" style="max-height:200px; max-width:200px"></td>
                            <td>{{ $element->created_at }}</td>
                            <td>{{ $element->updated_at }}</td>
                            <td>
                                <p><a href="/admin/element/{{$element->id}}/getupdate" class="btn btn-success btn-block">Edit</a></p> 
                                <form action="/admin/element/{{$element->id}}/postdelete" method="POST">
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
                    {!! $elements->appends(Request::input())->links() !!}
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
