@extends('layouts.app')

@section('content')


<div class="container-fluid" style="padding:4%"> 
    
    <h2 class="title-cart text-center" ><strong>Your Shopping Cart</strong></h2>
    <div class="card-total-cart text-center clearfix">
            <strong class="totalqty ">Total Items</strong>
            <strong class="totalqty " >({{$totalqty}})</strong>
    </div>
    
    <div style="padding:3%">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="table-wrapper-scroll-y-cart mx-auto" >
            <div class="card-box-cart-table-header table-bordered "style="padding-bottom:20px; padding-top:20px;" >
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-4 col-4 text-center"  >
                            <h6><strong class="text-center" >Product</strong></h6>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-3 text-center">
                            <h6><strong class="text-center" >Quantity</strong></h6>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-2 text-center">
                            <h6><strong class="text-center" >Total</strong></h6>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-3 text-center ">
                            <h6><strong  class="text-center" >Remove</strong></h6>
                        </div>                            
                    </div>
            </div>
            
            @if(count($orders) > 0)
                @foreach ($orders as $order)
                    @if(Auth::user() && $order->status==0)
                    
                <div class="card-box-cart-table-body table-bordered " style="padding-bottom:40px; padding-top:40px; " >
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2 table-data text-center " style="max-height:2%">
                            <a href="{{route('detailproduct', $order->product->id)}}"><img class="img-fluid card-image-cart-table " style="margin-left:20px" src="{{$order->product->images[0]->product_image}}"> </a>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-2 table-data text-center" >
                            <h6 class="text-center font-weight-light"  ><strong>{{$order->product->product_name}}</strong></h6>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-3 table-data text-center">
                            {{-- <h6 class="text-center"  >{{$order->qty}}</h6> --}}
                            <form action="{{route('updatecart', $order->product->id)}}" method="POST">
                                    {{csrf_field()}}
                                <button type="submit" id="cartBtn" class="btn btn-info btn-block" >
                                    <i class="fas fa-edit" > Edit</i> 
                                </button>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <input type="hidden" name="product_id" value="{{$order->product->id}}">
                                <input type="number" id="quantity"  name="quantity" class="form-control text-center input-number" style="border:none" value="{{$order->qty}}" min="1" max="100">
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-2 col-2 table-data text-center">
                            <h6 class=" text-center" >Rp. {{number_format($order->total)}}</h6>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-3 table-data text-center form-group" style="">
                            <a href="{{ route('deleteCart', $order->id) }}" class="btn btn" style="color:red" name="delete"><i class="fas fa-times"></i></a>
                        </div>                            
                    </div>      
                </div>
        
                    @endif
                @endforeach
            @else
                <h3>No posts found!</h3>
            @endif   
            
        </div>
    <div class="cart-summary " style="">
        <div class=" card-title-box-cart-summary" style="border-bottom: solid 3px #e0e0e0;">
            <h3 class=" text-right text-uppercase" ><em><strong>Sub Total</strong></em></h3>
        </div>
        <div class="card-total-bill-cart-summary text-right" style="padding-bottom:20px;">
            <h5><strong class="totalbill " >Rp. {{number_format($total)}}</strong></h5>
        </div>
        <div class="">
            <div class="row justify-content-end">
                <div class="card-button-cart-continue " >
                    <a href="{{route('userPage')}}"  class="btn btn-info" ><i class="fas fa-undo"> Continue Shopping</i></a>
                </div>
                <div class="card-button-cart-checkout " >
                    
                    <a href="{{route('checkoutgan')}}" name="action" value="update"  class="btn btn-success mx-3" style="margin-right:20px;"><i class="fas fa-handshake"> Checkout</i></a>
                    
                </div>  
            </div>
        </div> 
    </div>        
</div>
<div class="card-detail-product-title-random">
        <h2 style="padding-top:100px"><strong>Other Product</strong></h2>
    </div>
    <div class="row" style="padding-bottom:20px" >
            @if(count($productrandom) > 0)
                @foreach ($productrandom as $row)
                <div class="col-md-4 col-lg-2 col-sm-6 col-12" style="padding-bottom:20px; padding-top:20px; ">
                    <div class=" card-box-random " >
                        <div style="max-height:120px">
                            <a href="{{route('detailproduct', $row->id)}}"><img class="card-image-random rounded mx-auto d-block img-fluid " style="" src="{{ $row->images[0]->product_image}}"></a>
                        </div>
                        <div class="card-body-random clearfix" >
                                <div class="card-title-box-random">
                                    <h6 id="random-title-product-name" class="font-weight-light " ><strong>{{$row->product_name}}</strong></h6>
                                </div>
                                <div class="card-price-box-random ">
                                    <h6 class="text-center ">Rp. {{number_format($row->product_price)}}</h6>
                                </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                @else
                    <h2>No posts found!</h2>
                @endif
    </div>
</div>
    

@endsection
                                    

    
