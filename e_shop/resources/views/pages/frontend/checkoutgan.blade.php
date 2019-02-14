@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row" style="">
            <div class="col-12 col-lg-7 col-md-12 col-sm-12" style="background:#FAFAFA; border-right: solid 1px #e0e0e0; ">
                <div class="card-checkout-box-address" style=" margin-top:50px ">
                    <div class="card-body-address" >
                        <div class="card-checkout-title-address" style="padding-bottom:30px">
                            <h2 class="text-center " style="line-height: 50px;">Shipping Address</h2>
                        </div>
                        <h4 style="border-bottom: solid 1px #e0e0e0;">Contact information</h4>
                        <div style="font-size:20px;" class="">
                            <div class="row  justify-content-between font-weight-light" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3 " style="margin:20px 0 20px 0">
                                <span>Email</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                <span type="email" class="" name="email" placeholder="example@mail.com" value="">{{$users->email}}</span>      
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3" style="margin:20px 0 20px 0">
                                <span>Fullname</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                <span type="text" class="" name="fullname" placeholder="Name" value="">{{$users->fullname}}</span>
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3" style="margin:20px 0 20px 0">
                                <span>Address</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                <span type="text" class="" name="address" placeholder="Address" value="">{{$users->address}}</span>
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light" style="padding-bottom:10px">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3" style="margin:20px 0 20px 0">
                                <span>City</span>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                <span type="text" class="" name="city" placeholder="City" value="">{{$users->city}}</span>
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light" style="padding-bottom:30px; border-bottom: solid 1px #e0e0e0;">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3" style="margin:20px 0 20px 0">
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
            <div class="col-lg-5 col-md-12 col-sm-12 col-12" style="">
                    <div style="margin-top:50px ">
                    @if(count($orders) > 0)
                    <div class="card-box-checkout-table-body">
                        @foreach ($orders as $order)
                            @if(Auth::user() && $order->status==0)
                            <div class="card-box-checkout-table"style="padding-bottom:20px; padding-top:20px; ">
                                    <div class="row " style="width:100%">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 text-center">
                                            <a href="{{route('detailproduct', $order->product->id)}}"><img class="img-fluid" src="{{$order->product->images[0]->product_image}}"> </a>
                                            <div class="quantity-tags-checkout">
                                            <span >{{$order->qty}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-5 text-center" >
                                            <strong class="text-center">{{$order->product->product_name}}</strong>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center">
                                            <strong class=" text-center">Rp.{{number_format($order->qty * $order->product->product_price), 0}}</strong>
                                        </div>                   
                                    </div>
                            </div>
                            
                            @endif
                        @endforeach
                    </div>
                    @else
                        <h3>No posts found!</h3>
                    @endif
                    </div>
                    <div class="checkout-summary " style="">
                        <div class=" card-title-box-checkout">
                            <h3 class=" text-right "><em>Total</em></h3>
                        </div>
                        <div class="card-total-bill-checkout text-right" style="padding: 10px 20px 30px 0 ;">
                            <strong class="totalbill " style="font-size:25px; ">Rp.{{number_format($total), 0}}</strong>
                        </div>
                        <div style="ca">
                            <form action="{{ route('bayar', $order->id)}}" method="GET">
                                {{ csrf_field() }}
                                <span type="hidden" value="{{$order->status}}" name="status">
                            </form>
                            <a href="{{ route('bayar', $order->id)}}" class="btn btn-info btn-block" name="bayar">Payment</a>
                        </div>
                    </div> 
            </div>
                
    </div>
</div>
    
        
@endsection