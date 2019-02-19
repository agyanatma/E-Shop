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
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <h6 class="text-uppercase">Email </h6>
                                                    </div>:
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <h6 type="email" class="" name="email" placeholder="example@mail.com" value="">{{$users->email}}</h6>      
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <h6 class="text-uppercase">Fullname</h6>
                                                    </div>:
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                                    <h6 type="text" class="" name="fullname" placeholder="Name" value="">{{$users->fullname}}</h6>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <h6 class="text-uppercase">Address</h6>
                                                    </div>:
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                                    <h6 type="text" class="" name="address" placeholder="Address" value="">{{$users->address}}</h6>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <h6 class="text-uppercase">City</h6>
                                                    </div>:
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <h6 type="text" class="" name="city" placeholder="City" value="">{{$users->city}}</h6>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between font-weight-light">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                                    <h6 class="text-uppercase">Postal Code</h6>
                                                    </div>:
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <h6 type="text" class="" name="postal" placeholder="Postal Code" value="">{{$users->postal_code}}</h6>
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <div style="margin-top: 7%;margin-bottom:5%">
                            <h2 class="title-user text-center mx-5" style="line-height:200%" ><strong>History Order</strong></h2>
                        <div class="table-wrapper-scroll-y col-lg-12" >
                                            <table id="dtVerticalScrollExample " class="table table-striped table-bordered scrollingTable mx-auto"  >
                                                    <thead>
                                                    <tr>
                                                        <th class="th-sm text-center">Order Date</th>
                                                        <th class="th-sm text-center">Fullname</th>
                                                        <th class="th-sm text-center">Total Price</th>
                                                        <th class="th-sm text-center">Status</th>
                                                        <th class="th-sm text-center">Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @if(count($orders) > 0)
                                                            @foreach ($orders as $order)
                                                            <tr>
                                                                @if(Auth::user() && $order->status==2)
                                                                    <td class="align-middle text-center">{{date('d F, Y', strtotime($order->order_date))}} </td>
                                                                    <td class="align-middle text-center">{{$order}}</td>
                                                                    <td class="align-middle text-center">Rp. {{number_format($order->price,0)}}</td>
                                                                    <td class="align-middle text-center">{{$order->qty}}</td>
                                                                    <td class="align-middle text-center">Rp. {{number_format($order->total,0)}}</td>
                                                                    <td class="align-middle text-center">Already Paid</td>
                                                                @endif
                                                                @if(Auth::user() && $order->status==1)
                                                                    <td class="align-middle text-center">{{date('d F, Y', strtotime($order->order_date))}} </td>
                                                                    <td class="align-middle text-center">{{$order->fullname}}</td>
                                                                    <td class="align-middle text-center">Rp. {{number_format($order->total,0)}}</td>
                                                                    <td class="align-middle text-center">Waiting For Confirmation</td>
                                                                    <td class="align-middle text-center"><a href="{{route('detailorder', $order->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></td>
                                                                    
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
