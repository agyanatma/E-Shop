@extends('layouts.app')

@section('content')

   
        @if(count($errors)>0)
            <p class="alert alert-danger">Masukkan password untuk mengganti password</p>
        @endif
   
        <div class="container-fluid">
            <h1 class="text-center col-md-2 offset-5" style="margin-top: 15px">{{ config('app.name', 'E-Shop') }}</h1>
                <div class="row">
                            <div class="col-md-6 offset-3"  style="margin-top: 15px">
                                <div class="card card-login" style="">
                                    <div class="form-group ">
                                            <h3 class="card-title" class="text-center">Change Password</h3>
                                            <form action="{{route('updatepassword', $users->id)}}" method="POST" class="container">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                <label>Current Password:</label>
                                                <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="password" >
                                                </div>
                                                <div class="form-group">
                                                <label>New Password:</label>
                                                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Password" >
                                                </div>
                                                <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="password" class="form-control" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="Password" >
                                                </div>
                                                <div>
                                                <button type="submit" class="btn btn-info btn-block" style="float: center" name="action" value="create">Change Password</button>
                                                </div>
                                            </form>
                                    </div>
                                        
                                </div>
                            </div>
                    </div>
            </div>
        
            <br>                        
@endsection