@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

<link rel="stylesheet" href="/css/table.css">
    <div class="container-fluid" style="padding:4%">
            
                    <div class="row " >
                            <div class="col-lg-4 col-md-5 col-sm-12 col-12" >
                                    <form class="form-group" action="{{route('settings', $users->id)}}" method="GET" class="container clearfix " enctype="multipart/form-data">
                                            <h2 class="title-user text-center " ><strong>My Account
                                                <button type="submit" class="btn btn-info btn-profile " name="settings" value="update"><i class="fas fa-cogs"></i></button></strong>
                                            </h2>
                                    </form>
                                <div style="text-center mx-auto" >
                                    <div style="max-height:300px">
                                        <img src="{{$users->profile_image}}" class="card-image-user rounded mx-auto d-block img-fluid " >
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-12 col-12" >
                                    <div class="card-user-box-address " >
                                        <div class="card-body-user-address" >
                                            <h2 class="title-user text-center " ><strong>Contact information</strong></h2>
                                            <div style="font-size:20px;" class="">
                                                    <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                                                </div>
                                                                <h5 name="email" class="form-control input_user" >{{$users->email}}</h5>
                                                            </div>
                                                        @if ($errors->has('email'))
                                                        <div class="alert alert-danger">
                                                            {{$errors->first('email')}}
                                                         </div>
                                                        @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                                                </div>
                                                                <h5 class="form-control" name="fullname" >{{$users->fullname}}</h5>
                                                            </div>
                                                        @if ($errors->has('fullname'))
                                                        <div class="alert alert-danger">
                                                            {{$errors->first('fullname')}}
                                                        </div>               
                                                        @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                                                </div>
                                                                <h5 class="form-control" name="address" >{{$users->address}}</h5>
                                                            </div>
                                                        @if ($errors->has('address'))
                                                        <div class="alert alert-danger">
                                                            {{$errors->first('address')}}
                                                        </div>               
                                                        @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                                </div>
                                                                <h5 class="form-control" name="city" >{{$users->city}}</h5>
                                                           </div> 
                                                        @if ($errors->has('city'))
                                                        <div class="alert alert-danger">
                                                            {{$errors->first('city')}}
                                                        </div>               
                                                        @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                                                                </div>
                                                                <h5 class="form-control" name="postal" >{{$users->postal_code}}</h5>
                                                            </div>
                                                        @if ($errors->has('postal'))
                                                        <div class="alert alert-danger">
                                                            {{$errors->first('postal')}}
                                                        </div>               
                                                        @endif
                                                        </div>   
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    
    </div>
@endsection
