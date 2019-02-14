@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

<link rel="stylesheet" href="/css/table.css">
    <div class="container">
            
            <form class="form-group" action="{{route('settings', $users->id)}}" method="GET" class="container clearfix " enctype="multipart/form-data">
                    <h2 class="title-user text-center" style="margin:50px 0 20px 0; border-bottom: solid 1px #e0e0e0; padding-bottom:20px" >My Account
                        <button type="submit" class="btn btn-info btn-profile " name="settings" value="update"><i class="fas fa-cogs"></i></button>
                    </h2>
            </form>
                    <div class="row " >
                            <div class="col-lg-4 col-md-12 col-sm-12 col-12" >
                                <div style="text-center" >
                                    <div style="max-height:300px">
                                        <img src="{{$users->profile_image}}" class="card-image-user rounded mx-auto d-block img-fluid " >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 col-md-12 col-sm-12" >
                                    <div class="card-user-box-address">
                                        <div class="card-body-user-address" style="border: solid 1px #e0e0e0; background:#FAFAFA;">
                                            <h4 style="border-bottom: solid 1px #e0e0e0; ">Contact information</h4>
                                            <div style="font-size:20px;" class="">
                                                <div class="row  justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 " >
                                                    <span>Email</span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <span type="email" class="" name="email" placeholder="example@mail.com" value="">{{$users->email}}</span>      
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <span>Fullname</span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                                    <span type="text" class="" name="fullname" placeholder="Name" value="">{{$users->fullname}}</span>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <span>Address</span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                                    <span type="text" class="" name="address" placeholder="Address" value="">{{$users->address}}</span>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <span>City</span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <span type="text" class="" name="city" placeholder="City" value="">{{$users->city}}</span>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <span>Postal Code</span>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <span type="text" class="" name="postal" placeholder="Postal Code" value="">{{$users->postal_code}}</span>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <div style="padding-bottom:100px">
                            <h2 class="title-user text-center" style="margin:20px 0 20px 0; border-bottom: " >History Order</h2>
                        <div class="table-wrapper-scroll-y " >
                                            <table id="dtVerticalScrollExample " class="table table-striped table-bordered scrollingTable "  >
                                                    <thead>
                                                    <tr>
                                                        <th class="th-sm text-center">Product</th>
                                                        <th class="th-sm text-center">Price</th>
                                                        <th class="th-sm text-center">Quantity</th>
                                                        <th class="th-sm text-center">Total Price</th>
                                                        <th class="th-sm text-center">Order Date</th>
                                                        <th class="th-sm text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @if(count($orders) > 0)
                                                            @foreach ($orders as $order)
                                                            <tr>
                                                                @if(Auth::user() && $order->status==2)
                                                                    <td class="align-middle">{{$order->product->product_name}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($order->price), 0}}</td>
                                                                    <td class="align-middle">{{$order->qty}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($order->total), 0}}</td>
                                                                    <td class="align-middle">{{date('d F, Y', strtotime($order->order_date))}} </td>
                                                                    <td class="align-middle">Already Paid</td>
                                                                @endif
                                                                @if(Auth::user() && $order->status==1)
                                                                    <td class="align-middle">{{$order->product->product_name}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($order->price), 0}}</td>
                                                                    <td class="align-middle">{{$order->qty}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($order->total), 0}}</td>
                                                                    <td class="align-middle">{{date('d F, Y', strtotime($order->order_date))}} </td>
                                                                    <td class="align-middle">Waiting For Confirmation</td>
                                                                @endif
                                                            </tr>
                                                            @endforeach
                                                        @else
                                                            <h3>No posts found!</h3>
                                                        @endif
                                                </tbody>
                                            </table>
                                            
                                    </div>
                    </div>
    </div>
                

@endsection
