@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding: 4%; ">
    {{-- <form action="{{ route('bayar') }}" method="post" >
        {{csrf_field()}} --}}
        <div class="row" style="margin-bottom:8%">
        
            <div class="col-12 col-lg-7 col-md-12 col-sm-12" >
                <div class="card-checkout-box-address"style="background:#f2f2f2; border: solid 5px #e0e0e0;" >
                    <div class="card-body-address" style="height:auto">
                        <div class="card-checkout-title-address" style="padding-bottom:30px">
                            <h2 class="text-center " style="line-height: 200%;"><strong>Shipping Address</strong></h2>
                        </div>
                        <h4 style="border-bottom: solid 3px #e0e0e0;" class=" mx-1"><strong>Contact information</strong></h4>
                        <div style="font-size:20px;" class="">
                            <div class="row  justify-content-between font-weight-light" style="line-height:300%">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4 " >
                                <h6 class="text-uppercase" >Email</h6>
                                </div>:
                                <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                <h6 type="email" class=""  name="email" placeholder="example@mail.com" value="">{{$users->email}}</h6>      
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light text-justify" style="line-height:300%">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
                                <h6 class="text-uppercase" >Fullname</h6>
                                </div>:
                                <div class="col-lg-7 col-md-7 col-sm-7 col-7" >
                                <h6 type="text" class=""  name="fullname" placeholder="Name" value="">{{$users->fullname}}</h6>
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light text-justify" style="line-height:300%">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
                                <h6 class="text-uppercase" >Address</h6>
                                </div>:
                                <div class="col-lg-7 col-md-7 col-sm-7 col-7" >
                                <h6 type="text" class=""   name="address" placeholder="Address" value="">{{$users->address}}</h6>
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light text-justify" style="line-height:300%">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
                                <h6 class="text-uppercase" >City</h6>
                                </div>:
                                <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                <h6 type="text" class=""  name="city" placeholder="City" value="">{{$users->city}}</h6>
                                </div>
                            </div>
                            <div class="row justify-content-between font-weight-light text-justify" style="line-height:300%">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
                                <h6 class="text-uppercase" >Postal Code</h6>
                                </div>:
                                <div class="col-lg-7 col-md-7 col-sm-7 col-7">
                                <h6 type="text" class=""  name="postal" placeholder="Postal Code" value="">{{$users->postal_code}}</h6>
                                </div>
                            </div>     
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-12" style="padding-top:5%">
                    <div >
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
                                            <h6 class="text-center font-weight-light"><strong>{{$order->product->product_name}}</strong></h6>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center">
                                            <h6 class=" text-center font-weight-light"><strong>Rp. {{number_format($order->total)}}</strong></h6>
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
                    <div class="checkout-summary clearfix" style="">
                        <div class=" card-title-box-checkout">
                            <h3 class=" text-right "><em><strong>Total</strong></em></h3>
                        </div>
                        <div class="card-total-bill-checkout text-right" style="padding: 10px 20px 10px 0 ;">
                            <h5 class="totalbill " style="font-size:25px; "><strong>Rp. {{number_format($total)}}</strong></h5>
                            <input type="hidden" name="total" value="{{$total}}">
                        </div>
                        <div style="card-payment-checkout">
                            {{-- <form action="{{ route('bayar', $order->id)}}" method="GET">
                                {{ csrf_field() }}
                                <span type="hidden" value="{{$order->status}}" name="status"></span>
                            </form> --}}
                            {{-- <button type="submit" class="btn btn-success  mx-3" style="float: right"><i class="fas fa-money-check"> Payment</i></button> --}}
                            <a href="{{ route('paymentcard')}}" class="btn btn-success  mx-3" style="float:right; " name="payment">Payment</i></a>
                        </div>
                    </div> 
            </div>
        </div>
    </form>
</div>
    
        
@endsection