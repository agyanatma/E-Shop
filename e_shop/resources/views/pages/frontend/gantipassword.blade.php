@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding:4%">
        
           
                    <div class="col-12 col-md-8 col-lg-6 col-sm-9 offset-sm-2 offset-md-2 offset-lg-3 "  >
                            <div class="card card-login" style="background:#f2f2f2; border: solid 5px #e0e0e0;">
                                <div class="form-group " >
                                        <h2 class="title-user text-center " ><strong>Change Password</strong></h2>
                                        <form action="{{route('updatepassword', $users->id)}}" method="POST" class="container" >
                                            {{csrf_field()}}
                                            
                                            @if (session('status'))
                                                <div class="alert alert-success text-center">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger text-center">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                                            
                                            <div class="form-group">
                                            <label>Current Password:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger text-center">
                                                    {{$errors->first('password')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label>New Password:</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" required>
                                                @if ($errors->has('newpassword'))
                                                    <div class="alert alert-danger text-center">
                                                    {{$errors->first('newpassword')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                            <label>Confirm New Password</label>
                                            <input type="password" class="form-control" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="New Password Confirm" required>
                                                @if ($errors->has('newpasswordconfirm'))
                                                    <div class="alert alert-danger text-center">
                                                    {{$errors->first('newpasswordconfirm')}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group text-right">
                                            <button type="submit" class="btn btn-info " style="float: center" name="action" value="update"><i class="fas fa-save"> Save</i></button>
                                            </div>
                                        </form>
                                </div>
                                    
                            </div>
                        </div>
                        
            </div>
</div>
    
   
                         
@endsection