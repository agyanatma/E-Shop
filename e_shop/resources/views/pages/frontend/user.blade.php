@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

<link rel="stylesheet" href="/css/table.css">
    <div class="container-fluid" style="padding:4%">
            <form class="form-group" action="{{route('settings', $users->id)}}" method="GET" class="container clearfix " enctype="multipart/form-data">
                    <h2 class="title-user text-left ml-5" style="  border-bottom: solid 1px #e0e0e0; padding-bottom:20px" ><strong>My Account
                        <button type="submit" class="btn btn-info btn-profile " name="settings" value="update"><i class="fas fa-cogs"></i></button></strong>
                    </h2>
            </form>
                    <div class="row " >
                            <div class="col-lg-4 col-md-12 col-sm-12 col-12" >
                                <div style="text-center mx-auto" >
                                    <div style="max-height:300px">
                                        <img src="{{$users->profile_image}}" class="card-image-user rounded mx-auto d-block img-fluid " >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 col-md-12 col-sm-12" >
                                    <div class="card-user-box-address " >
                                        <div class="card-body-user-address" style="border: solid 5px #e0e0e0; background:#f2f2f2;">
                                            <h4 style="border-bottom: solid 3px #e0e0e0; line-height:200%" class="font-wight-light text-left"><strong>Contact information</strong></h4>
                                            <div style="font-size:20px;" class="">
                                                <div class="row justify-content-between font-weight-light" >
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <p class="text-left">Email </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                                    <p class="text-center">:</p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <p type="email" class="text-justify" name="email" placeholder="example@mail.com" value="">{{$users->email}}</p>      
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" >
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <p class="text-left">Fullname</p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                                    <p class="text-center">:</p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                                    <p type="text" class="text-justify" name="fullname" placeholder="Name" value="">{{$users->fullname}}</p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" >
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <p class="text-left">Address</p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                                    <p class="text-center">:</p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                                    <p type="text" class="text-justify" name="address" placeholder="Address" value="">{{$users->address}}</p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" >
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <p class="text-left">City</p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                                    <p class="text-center">:</p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <p type="text" class="text-justify" name="city" placeholder="City" value="">{{$users->city}}</p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <p class="text-left">Postal Code</p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                                    <p class="text-center">:</p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <p type="text" class="text-justify" name="postal" placeholder="Postal Code" value="">{{$users->postal_code}}</p>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    
    </div>
@endsection
