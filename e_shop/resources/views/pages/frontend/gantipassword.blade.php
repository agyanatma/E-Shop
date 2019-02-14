@extends('layouts.app')

@section('content')
<div class="container">
        <h2 class="title-user text-center text-uppercase" style="align-text:center; padding-top:10px">Change Password</h2>
            <div class="row justify-content-between" style="padding-bottom:100px">
                    <div class="col-md-6 offset-3"  style="margin-top: 15px">
                            <div class="card card-login" style="">
                                <div class="form-group " >
                                        <form action="{{route('updatepassword', $users->id)}}" method="POST" class="container" style="padding:50px 10px 30px 10px">
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
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger">
                                                    {{$errors->first('password')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label>New Password:</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" required>
                                                @if ($errors->has('newpassword'))
                                                    <div class="alert alert-danger">
                                                    {{$errors->first('newpassword')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" class="form-control" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="New Password Confirm" required>
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