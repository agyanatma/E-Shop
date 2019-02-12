@extends('layouts.app')

@section('content')
<div class="container">
        <h1> Checkout</h1>
    <div class="row">
            <div class="col-md-8">
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
                <div>
                        @if(count($orders) > 0)
                            @foreach ($orders as $order)
                            @if(Auth::user() && $order->status==0 )
                                <div class="col-md-8 card "style="padding-bottom:20px; padding-top:20px; ">
                                    <div class="row">
                                        <div class=" col-md-2">
                                            <a href="{{route('detailproduct', $order->product->id)}}"> <img style="width:100px" class="img-fluid" src="{{$order->product->images[0]->product_image}}"> </a>
                                        </div>
                                        <div class="clearfix col-md-5" >
                                            <h6>{{$order->product->category_name}}</h6>
                                            <h6>{{$order->product->product_name}}</h6>
                                            <h6>Rp. {{number_format($order->product->product_price), 0}}</h6>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <h6>Items :{{$order->qty}}</h6>
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
            <div class="col-md-4 card">
                
                <h2 class="text-center">Shopping Summary</h2>
                <h4 class="text-center"> Total Items:  {{$totalqty}}</h4>
            
                <h4 class="text-center"> Total Bill: Rp. {{number_format ($total), 0}}</h4>
                <form action="{{ route('bayar', $order->id)}}" method="GET">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$order->status}}" name="status">
                </form>
                <a href="{{ route('bayarlangsung', $order->id)}}" class="btn btn-info btn-block" name="bayar">Pay</a>
            </div>
    </div>
</div>
    
        
@endsection