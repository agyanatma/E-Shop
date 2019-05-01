@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding-left:4%;padding-right:4%;padding-top:4%;">
        <div class="row align-items-start" >
            <div class="col-12 col-lg-7 col-md-12 col-sm-12" >
                <div class="card-checkout-box-address">
                    <div class="card-body-address" >
                        <div class="card-checkout-title-address" >
                            <h2 class="text-center " style="line-height: 200%;"><strong>Shipping Address</strong></h2>
                        </div>
                        <h4 style="border-bottom: solid 3px #e0e0e0;" class=" mx-1"><strong>Contact information</strong></h4>
                        <div style="font-size:20px;" class="">
                                <div class="row  justify-content-between font-weight-light " >
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 " >
                                    <h5 class="text-left" style="margin-left:5%" >Email</h5>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                    <h5 class="text-center">:</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                    <h5 type="email" class=""  name="email" placeholder="example@mail.com" value="">{{$users->email}}</h5>      
                                    </div>
                                </div>
                                <div class="row justify-content-between font-weight-light text-justify" >
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                    <h5 class="text-left" style="margin-left:5%" >Fullname</h5>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                    <h5 class="text-center">:</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                    <h5 type="text" class=""  name="fullname" placeholder="Name" value="">{{$users->fullname}}</h5>
                                    </div>
                                </div>
                                <div class="row justify-content-between font-weight-light text-justify" >
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                    <h5 class="text-left" style="margin-left:5%" >Address</h5>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                    <h5 class="text-center">:</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8" >
                                    <h5 type="text" class=""   name="address" placeholder="Address" value="">{{$users->address}}</h5>
                                    </div>
                                </div>
                                <div class="row justify-content-between font-weight-light text-justify" >
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                    <h5 class="text-left" style="margin-left:5%" >City</h5>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                    <h5 class="text-center">:</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                    <h5 type="text" class=""  name="city" placeholder="City" value="">{{$users->city}}</h5>
                                    </div>
                                </div>
                                <div class="row justify-content-between font-weight-light text-justify" >
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3" >
                                    <h5 class="text-left" style="margin-left:5%" >Postal Code</h5>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-1" >
                                    <h5 class="text-center">:</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                    <h5 type="text" class=""  name="postal" placeholder="Postal Code" value="">{{$users->postal_code}}</h5>
                                    </div>
                                </div>     
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 col-12" >
                    <div >
                        
                <?php $sum_tot_Price = 0 ?>
                    @if(count($orders) > 0)
                    <div class="card-box-checkout-table-body table-wrapper-scroll-y-checkout"> 
                        @foreach ($orders as $order)
                            @if(Auth::user() && $order->status==0)
                            <div class="card-box-checkout-table "style="padding-bottom:20px; padding-top:20px; ">
                                    <div class="row " style="width:100%">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3 text-center">
                                            <a href="{{route('detailproduct', $order->product->id)}}"><img class="img-fluid" src="{{$order->product->images[0]->product_image}}"> </a>
                                            <div class="quantity-tags-checkout">
                                            <span >{{$order->qty}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-5 text-center" >
                                            <h6 class="text-center font-weight-light  text-title-checkout"><strong>{{$order->product->product_name}}</strong></h6>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center">
                                            <input type="hidden" name="product_id" value="{{$order->product->id}}">
                                            <input type="hidden" Rp. {{number_format($sum_tot_Price = $sum_tot_Price + ($sum_product_Price =$order->product->product_price * $order->qty))}}>
                                            <h6 class=" text-center font-weight-light"><strong>Rp. {{number_format($sum_product_Price =$order->product->product_price * $order->qty)}}</strong></h6>
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
                        <form action="{{ route('bayar', $order->id) }}" method="post" >
                                    {{csrf_field()}}
                        <div class=" card-title-box-checkout">
                            <h3 class=" text-right "><em><strong>Total</strong></em></h3>
                        </div>
                        <div class="card-total-bill-checkout text-right" style="padding: 10px 20px 10px 0 ;">
                            <h5 class="totalbill " style="font-size:25px; "><strong>Rp.{{number_format($sum_tot_Price = $sum_tot_Price)}}</strong></h5>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        </div>
                        <div style="card-payment-checkout">
                            <button type="submit" class="btn btn-success  mx-3" style="float: right"><i class="fas fa-money-check"> Payment</i></button>
                            {{-- <a href="{{ route('paymentcard')}}" class="btn btn-success  mx-3" style="float:right; " name="payment">Payment</i></a> --}}
                        </div>
                    </div> 
            </div>
        </div>
    </form>
</div>
    
        
@endsection