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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h4>Insert User</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/user" enctype="multipart/form-data">
                        {{ csrf_field() }}                        

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" 
                                value="{{ (old('name')) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" 
                                value="{{ (old('email')) ? old('email') : $user->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="profile_pic" class="col-md-4 control-label">Profile Picture</label>
                            <div class="col-md-6">
                                <input id="profile_pic" type="file" class="form-control" name="profile_pic">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <select name="gender" id="gender_select" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dob" class="col-md-4 control-label">Date Of Birth</label>
                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob"
                                value="{{ (old('dob')) ? old('dob') : $user->dob }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>
                            <div class="col-md-6">
                                <textarea name="address" id="address" class="form-control" cols="40" rows="10">{{ (old('address')) ? old('address') : $user->address }}
                                </textarea>
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
