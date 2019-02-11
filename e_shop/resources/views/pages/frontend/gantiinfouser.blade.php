@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')  

        
<div class="container">
        <div style="padding:30px; padding-top:60px; margin:auto align-text:center">
                <div class="row ">
                    <div class="col-md-4 text-center " >
                        <div>
                                <form class="form-group" action="{{route('gantipassword', Auth::user())}}" method="GET" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <h1 class="text-center" style="align-text:center">Password
                                                <button type="submit" class="btn btn-info btn-profile " name="password" value="update"><i class="fas fa-key"></i></button>
                                        </h1>
                                </form> 
                        </div>
                <form action="{{route('editUser', Auth::user())}}" method="post"  enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div style="padding-bottom:10px">
                            <img src="{{$users->profile_image}}" class="img-responsive " style="width:auto; height:335px; border-radius:50% margin-right:25px">
                        </div>
                        <div class="form-group" >
                            <input  type="file"  name="img" >
                        </div>
                    </div>
                    <div class="col-md-8" >
                        <h1> {{$users->fullname}}</h1>
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
                            <div class="form-group ">
                                    <div class="row " style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <label>Email</label>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="email" class="form-control" name="email" placeholder="example@mail.com" >
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger">
                                                    {{$errors->first('email')}}
                                                 </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <label>Fullname</label>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="fullname" placeholder="Name" >
                                            @if ($errors->has('fullname'))
                                                <div class="alert alert-danger">
                                                    {{$errors->first('fullname')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <label>Address</label>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="address" placeholder="Address" >
                                            @if ($errors->has('address'))
                                                <div class="alert alert-danger">
                                                    {{$errors->first('address')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <label>City</label>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="city" placeholder="City" >
                                            @if ($errors->has('city'))
                                                <div class="alert alert-danger">
                                                    {{$errors->first('city')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">  
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-2">
                                        <label>Postal Code</label>
                                        </div>
                                        <div class="col-md-10">
                                        <input type="text" class="form-control" name="postal" placeholder="Postal Code" >
                                            @if ($errors->has('postal'))
                                                <div class="alert alert-danger">
                                                    {{$errors->first('postal')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group " style="padding-bottom:10px">
                                    <button type="submit" class="btn btn-info btn-block " name="action" value="update">Simpan</button>
                                </div>
                    </div>  
                </form>    
                </div>
                     
        </div>
</div>
@endsection