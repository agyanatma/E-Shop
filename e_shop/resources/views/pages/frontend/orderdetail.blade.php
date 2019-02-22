@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding:4%;">
        <h2 class="title-cart text-center "  ><strong >Detail Order</strong></h2>
        <div class="card-total-cart text-center clearfix pb-2">
                <strong class="totalqty ">Total Items</strong>
                <strong class="totalqty " >({{$totalqty}})</strong>
        </div>
        <div>
            @if(Auth::User()->id && $orders->status == 0)
            <div class="clearfix">
                <h4>Status</h4> 
                <div class="row justify-content-around">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-6" >
                        <h5 class="text-danger" style="line-height:2"><strong>Not Yet Paid</strong></h5>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-6 text-center" >
                        <div class="row">
                            <div class="col-lg-11 col-sm-11 col-md-11 col-11 text-right" >
                                <a href="{{ route('paymentcard', $orders->id)}}" class="btn btn-danger  " name="payment" ><i class="fas fa-money-check"> Paid Now</i></a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            @endif
            @if(Auth::User()->id && $orders->status == 1)
            <div class="">
                <h4>Status</h4> 
                <p class="text-info"><strong>Waiting For Confirmation</strong></p>
            </div>
            @endif
            @if(Auth::User()->id && $orders->status == 2)
            <div class="">
                <h4>Status</h4> 
                <p class="text-success"><strong>Already Paid</strong></p>
            </div>
            @endif
            <div class="">
                <h4>Order Date</h4>
                <p class=""> {{date('d F Y', strtotime($orders->order_date))}} at {{date('g:ia', strtotime($orders->updated_at))}}</p>
            </div>
        </div>
            <div>
                <h4 class="pb-2 pt-5">List Products</h4>
            </div>
        
        <div class="" style="margin-bottom:20px">
            <div class="card-body">
                        
               
                <div class="" style="padding-bottom:20px; padding-top:20px; border-top: 3px solid #e0e0e0; border-bottom: 3px solid #e0e0e0" >
                    @foreach ($details as $detail)
                    <div class="card-box-cart-table-body " style=" " >
                        <div class="row justify-content-around" style="padding-bottom:20px; padding-top:20px; ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 table-data text-center " style="max-height:2% ">
                                <div class="row" style="border-right:3px solid #e0e0e0 ">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 form-inline" style="height:80px">
                                    <a href="{{route('detailproduct', $detail->product->id)}}"><img class="card-image-cart-table " style="margin-left:20px" src="{{$detail->product->images[0]->product_image}}"> </a>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">  
                                    <h5 class="text-left "  >{{$detail->product->categories->category_name}}</h5>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            @if(Auth::User()->id && $orders->status == 0)
                                            <h5 class="text-left text-danger"  >{{$detail->qty}} Items </h5>
                                            @endif
                                            @if(Auth::User()->id && $orders->status == 1)
                                            <h5 class="text-left text-info"  >{{$detail->qty}} Items </h5>
                                            @endif
                                            @if(Auth::User()->id && $orders->status == 2)
                                            <h5 class="text-left text-success"  >{{$detail->qty}} Items </h5>
                                            @endif
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            @if(Auth::User()->id && $orders->status == 0)
                                            <h5 class="text-left text-danger"  >x</h5>
                                            @endif
                                            @if(Auth::User()->id && $orders->status == 1)
                                            <h5 class="text-left text-info"  >x</h5>
                                            @endif
                                            @if(Auth::User()->id && $orders->status == 2)
                                            <h5 class="text-left text-success"  >x</h5>
                                            @endif
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            @if(Auth::User()->id && $orders->status == 0)
                                            <h5 class="text-left text-danger"  > Rp. {{number_format($detail->price)}}</h5>
                                            @endif
                                            @if(Auth::User()->id && $orders->status == 1)
                                            <h5 class="text-left text-info"  > Rp. {{number_format($detail->price)}}</h5>
                                            @endif
                                            @if(Auth::User()->id && $orders->status == 2)
                                            <h5 class="text-left text-success"  > Rp. {{number_format($detail->price)}}</h5>
                                            @endif
                                        </div>
                                    </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 table-data text-left">
                               <H5> Sub total</H5>
                                @if(Auth::User()->id && $orders->status == 0)
                                <h5 class="text-danger">Rp. {{number_format($detail->price * $detail->qty)}} </h5>
                                @endif
                                @if(Auth::User()->id && $orders->status == 1)
                                <h5 class="text-info">Rp. {{number_format($detail->price * $detail->qty)}} </h5>
                                @endif
                                @if(Auth::User()->id && $orders->status == 2)     
                                <h5 class="text-success">Rp. {{number_format($detail->price * $detail->qty)}} </h5>
                                @endif    
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-3 table-data text-center ">
                                <form  action="{{route('langsungbayar', $detail->product->id)}}" method="POST">
                                    {{csrf_field()}} 
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="product_id" value="{{$detail->product->id}}">
                                    <button type="submit" id="cartBtn" class="btn btn-success"><i class="fas fa-money-bill"></i> <i class="fas ">Buy Again</i>  </button>
                                </form>
                            </div> 
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6" style="">
                <div style="height:150px" class="my-4">
                    <h4 class="" style="line-height:2; " ><strong>Shipping Address</strong></h4>
                    <div  >
                    <h4 >Sent to <strong style="border-bottom: 3px solid #e0e0e0;">{{$orders->fullname}}</strong></h4>
                    <p class="text-justify">{{$orders->address}}, {{$orders->city}}, {{$orders->postal_code}}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <div style="height:150px" class="my-4">
                    <h4 class="text-right" style="line-height:2;"><strong >Payment</strong></h4>
                    <div>
                    <h4 class=" text-right "><a  style="border-bottom: 3px solid #e0e0e0;">Total payment costs</a></h4>
                    @if(Auth::User()->id && $orders->status == 0)
                    <p class="text-right text-danger " style="font-size:25px; "><strong>Rp.{{number_format($orders->total)}}</strong></p>
                    @endif
                    @if(Auth::User()->id && $orders->status == 1)
                    <p class="text-right text-info " style="font-size:25px; "><strong>Rp.{{number_format($orders->total)}}</strong></p>
                    @endif
                    @if(Auth::User()->id && $orders->status == 2)
                    <p class="text-right text-success " style="font-size:25px; "><strong>Rp.{{number_format($orders->total)}}</strong></p>
                    @endif
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection