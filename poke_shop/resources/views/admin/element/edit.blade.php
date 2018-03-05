@extends('layouts.admin')

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

    <div class="row">
       <div class="col-md-12 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Update Element</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="/admin/element/{{ $element->id }}/postupdate" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Element Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name"  value="{{ (old('name')) ? old('name') : $element->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=element_img class="col-md-4 control-label">Element Image</label>
                            <div class="col-md-6">
                                <input id="element_img" type="file" class="form-control" name="element_img">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="hidden" name="_method" value="PUT">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>                                
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>       
</div>
@endsection
