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
                    <div class="col-lg-8 col-md-7 col-sm-12 col-12" >
                        <div class="card-user-change">
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
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control input_user" value="{{$users->email}}" placeholder="example@mail.com">
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
                                    <input type="text" class="form-control" name="fullname" placeholder="Nama" value="{{$users->fullname}}" required>
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
                                    <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{$users->address}}" required>
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
                                    <input type="text" class="form-control" name="city" placeholder="Kota" value="{{$users->city}}" required>
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
                                    <input type="text" class="form-control" name="postal" placeholder="Kode Pos" value="{{$users->postal_code}}" required>
                                </div>
                            @if ($errors->has('postal'))
                            <div class="alert alert-danger">
                                {{$errors->first('postal')}}
                            </div>               
                            @endif
                            </div>
                                <div class="form-group text-right" style="padding-bottom:10px">
                                    <button type="submit" class="btn btn-info mx-auto  " name="action" value="update"><i class="fas fa-save"> Save</i> </button>
                                </div>
                        </div>
                    </div>  
                </form>    
                </div>
                     
        </div>
</div>
@endsection