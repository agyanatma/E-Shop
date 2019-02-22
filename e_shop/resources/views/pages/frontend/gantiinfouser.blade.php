@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')  

        
<div class="container-fluid" style="padding:4%">
        
                <div class="row ">
                    <div class="col-lg-4 col-md-5 col-sm-12 col-12 text-center " >
                        <div>
                            <form class="form-group" action="{{route('gantipassword', Auth::user())}}" method="GET" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <h2 class="title-user text-center " style="align-text:center"><strong>Change Password</strong>
                                    <button type="submit" class="btn btn-info btn-profile " name="password" value="update"><i class="fas fa-key"></i></button>
                                </h2>
                            </form> 
                        </div>
                <form action="{{route('editUser', Auth::user())}}" method="post"  enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div style="max-height:300px; padding-bottom:20px">
                            <img src="{{$users->profile_image}}" class="card-image-user-change rounded mx-auto d-block img-fluid " >
                        </div>
                        <div class="form-group text-center" style="padding-top:20px">
                            <input type="file"  name="img" >
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12 col-12" style="background:#f2f2f2; border: solid 5px #e0e0e0;">
                        <h2 class="title-user text-center " style="line-height:200%" ><strong>Change Profile</strong></h2>
                        @if (session('status'))
                            <div class=" text-center alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif
                            <div class="form-group ">
                                    <div class="row " style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <h6>Email</h6>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{$users->email}}">
                                            @if ($errors->has('email'))
                                            <div>
                                                <span >
                                                    {{$errors->first('email')}}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <h6>Fullname</h6>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="fullname" placeholder="Name" value="{{$users->fullname}}">
                                            @if ($errors->has('fullname'))
                                                <div class="alert alert-danger text-center">
                                                    {{$errors->first('fullname')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <h6>Address</h6>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="address" placeholder="Address" value="{{$users->address}}">
                                            @if ($errors->has('address'))
                                                <div class="alert alert-danger text-center">
                                                    {{$errors->first('address')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <h6>City</h6>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="city" placeholder="City" value="{{$users->city}}">
                                            @if ($errors->has('city'))
                                                <div class="alert alert-danger text-center">
                                                    {{$errors->first('city')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">  
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <h6>Postal Code</h6>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="postal" placeholder="Postal Code" value="{{$users->postal_code}}">
                                            @if ($errors->has('postal'))
                                                <div class="alert alert-danger text-center">
                                                    {{$errors->first('postal')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right" style="padding-bottom:10px">
                                    <button type="submit" class="btn btn-info mx-auto  " name="action" value="update"><i class="fas fa-save"> Save</i> </button>
                                </div>
                    </div>  
                </form>    
                </div>
                     
        </div>
</div>
@endsection