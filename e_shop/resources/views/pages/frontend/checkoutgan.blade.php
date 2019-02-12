@extends('layouts.app')

@section('content')
<div class="container">
        <h1> Checkout</h1>
    <div class="row" >
            <div class="col-12 col-lg-8" >
                <div class="text-left">
                    <div class="card" >
                        <div class="wrapper" style="margin-left:20px">
                            <h2 class="text-center">Shipping Address</h2>
                        <div>
                            <h4>{{$users->fullname}}</h4>
                        </div>
                            <p>{{$users->address}}, {{$users->city}}, {{$users->postal_code}}</p>
                        </div>
                    </div>
                </div>
                <div style="border: 1px solid lightgray;">
                        <div class="col-md-8 card-box-cart-table"style="padding-bottom:20px; padding-top:20px; ">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 offset-1 text-center">
                                        <span>Product Details</span> 
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                                            <span>Quantity</span>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                                            <span>Total</span>
                                    </div>
                                                               
                                </div>
                        </div>
                        @if(count($orders) > 0)
                            @foreach ($orders as $order)
                                @if(Auth::user() && $order->status==0)
                                <div class="col-md-8 card-box-cart-table"style="padding-bottom:20px; padding-top:20px; ">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 offset-1 text-center">
                                                <a href="{{route('detailproduct', $order->product->id)}}"><img class="img-fluid" src="{{$order->product->images[0]->product_image}}"> </a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center" >
                                                <span class="text-justify text-center">{{$order->product->product_name}}</span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                                                <span class="text-center">{{$order->qty}}</span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                                                <span class="text-justify text-center">Rp.{{number_format($order->product->product_price), 0}}</span>
                                            </div>
                                                                       
                                        </div>
                                </div>
                            @endif
                        @endforeach
                        @else
                            <h3>No posts found!</h3>
                        @endif
                    </div>
            </div>
            <div class="col-12 col-lg-4 ">
                    <div class="cart-summary " style="">
                        <h2 class="card-title-box-cart text-center" >Summary</h2>
                        <div class="card-total-cart clearfix" >
                            <span class="totalqty " style="float:left">Total Items:</span>
                            <span class="totalqty " style="float:right">{{$totalqty}}</span>
                        </div>
                        <div class="card-total-bill-cart clearfix " > 
                            <span class="totalbill " style=" float:left">Total Bill:</span>
                            <span class="totalbill " style="float:right">Rp {{number_format($total), 0}}</span>
                        </div>
                        <form action="{{ route('bayar', $order->id)}}" method="GET">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$order->status}}" name="status">
                        </form>
                        <a href="{{ route('bayar', $order->id)}}" class="btn btn-info btn-block" name="bayar">Pay</a>
                    </div>                      
            </div>
            {{-- <div class="col-md-4 card">
                
                <h2 class="text-center">Shopping Summary</h2>
                <h4 class="text-center"> Total Items:  {{$totalqty}}</h4>
            
                <h4 class="text-center"> Total Bill: Rp. {{number_format ($total), 0}}</h4>
                <form action="{{ route('bayar', $order->id)}}" method="GET">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$order->status}}" name="status">
                </form>
                    <a href="{{ route('bayar', $order->id)}}" class="btn btn-info btn-block" name="bayar">Pay</a>
            
            </div> --}}
    </div>
</div>
    
        
@endsection