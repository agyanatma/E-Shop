@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

<link rel="stylesheet" href="/css/table.css">
    <div class="container">
            <div style="padding:15px;  margin:auto">
                    <div class="row " >
                            <div class="col-md-4">
                                <img src="{{$users->profile_image}}" class="rounded-circle img-responsive mx-auto d-block" style="width:auto; height:200px; margin-right:25px">
                            </div>
                            <div class="col-md-8 " >
                                    <form class="form-group" action="{{route('settings', $users->id)}}" method="GET" class="container clearfix " enctype="multipart/form-data">
                                            <h1 class="text-center " style="align-text:center">Profile
                                                    <button type="submit" class="btn btn-info btn-profile " name="settings" value="update"><i class="fas fa-cogs"></i></button>
                                            </h1>
                                    </form>
                                    
                                    <h2 class="text-justify"> {{$users->fullname}}</h2>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <h4 class="far fa-envelope "></h4> 
                                        </div>
                                        <div class="col">
                                            <h4 class="text-justify">{{$users->email}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <h4 class="fas fa-home"></h4> 
                                        </div>
                                        <div class="col">
                                            <h4 class="text-justify">{{$users->address}}, {{$users->city}}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1">
                                            <h4 class="far fa-paper-plane"></h4> 
                                        </div>
                                        <div class="col">
                                            <h4 class="text-justify">{{$users->postal_code}}</h4>
                                        </div>
                                    </div>
                           
                            </div>
                    </div>
            </div>
        </div> 
                    <div class="container">
                                <h1 class="text-center"> History Order</h1>
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
