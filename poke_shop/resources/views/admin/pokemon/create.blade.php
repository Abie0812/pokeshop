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
                <div class="panel-heading"><h4>Insert Pokemon</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ url('/admin/pokemon/postinsert') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="element" class="col-md-4 control-label">Element</label>
                            <div class="col-md-6">
                                <select name="element" class="form-control">
                                    <option value="0">None</option>
                                    @foreach($elements as $element)
                                        <option value="{{ $element->id }}">{{ $element->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="img_pokemon" class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="img_pokemon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="Male"> Male
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="Female"> Female
                                </label>                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">Price</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">Insert</button>                                
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
