@extends('layouts.app')

@section('content')
<div class="container">
        <h1 class="text-center col-md-2 offset-5" style="margin-top: 15px">{{ config('app.name', 'E-Shop') }}</h1>
            <div class="row">
                    <div class="col-md-6 offset-3"  style="margin-top: 15px">
                            <div class="card card-login" style="">
                                <div class="form-group ">
                                        <h3 class="card-title" class="text-center">Change Password</h3>
                                        <form action="{{route('updatepassword', $users->id)}}" method="POST" class="container">
                                            {{csrf_field()}}
                                            
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            <div class="form-group">
                                            <label>Current Password:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger">
                                                    {{$errors->first('password')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label>New Password:</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Password" required>
                                                @if ($errors->has('newpassword'))
                                                    <div class="alert alert-danger">
                                                    {{$errors->first('newpassword')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" class="form-control" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="Password" required>
                                                @if ($errors->has('newpasswordconfirm'))
                                                    <div class="alert alert-danger">
                                                    {{$errors->first('newpasswordconfirm')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                            <button type="submit" class="btn btn-info btn-block" style="float: center" name="action" value="update">Change Password</button>
                                            </div>
                                        </form>
                                </div>
                                    
                            </div>
                        </div>
            </div>
</div>
    
   
                         
@endsection