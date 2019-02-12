@extends('layouts.app')

@section('content')

{{-- <div class="col-md-8 card-box-cart-table"style="padding-bottom:20px; padding-top:20px; ">
        <div class="row row-table">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 col-table text-center">
                <div class="col-content bg">
                    Product Details
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center">
                <div class="col-content bg">
                    Quantity
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center">
                <div class="col-content bg">
                    Total
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center ">
                <div class="col-content bg">
                    Remove
                </div>
            </div>                            
        </div>
</div>
@if(count($orders) > 0)
    @foreach ($orders as $order)
        @if(Auth::user() && $order->status==0)
        <div class="col-md-8 card-box-cart-table"style="padding-bottom:20px; padding-top:20px; ">
                <div class="row row-table">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center">
                        <div class="col-content bg">
                        <a href="{{route('detailproduct', $order->product->id)}}"><img class="img-fluid" src="{{$order->product->images[0]->product_image}}"> </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 col-table text-center" >
                        <div class="col-content bg text-justify text-center">
                            {{$order->product->product_name}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center">
                        <div class="col-content bg text-center">
                            {{$order->qty}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center">
                        <div class="col-content bg text-justify text-center">
                            Rp.{{number_format($order->product->product_price), 0}}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 col-table text-center ">
                        <div class="col-content bg">
                            <a href="{{ route('deleteCart', $order->id) }}" class="btn btn-info" name="delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </div>                            
                </div>
        </div>
    @endif
@endforeach
@else
    <h3>No posts found!</h3>
@endif
</div> --}}
<div class="container">
        <div class="row row-cart ">
            <div class="col-12 col-lg-8" style="">
                <h2 class="title-cart text-center">Shopping Cart</h2>
                    <div style="border: 1px solid lightgray;">
                        <div class="col-md-8 card-box-cart-table"style="padding-bottom:20px; padding-top:20px; ">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-center">
                                        <span>Product Details</span> 
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                                            <span>Quantity</span>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                                            <span>Total</span>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center ">
                                            <span>Remove</span>
                                    </div>                            
                                </div>
                        </div>
                        @if(count($orders) > 0)
                            @foreach ($orders as $order)
                                @if(Auth::user() && $order->status==0)
                                <div class="col-md-8 card-box-cart-table"style="padding-bottom:20px; padding-top:20px; ">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
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
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center ">
                                                <a href="{{ route('deleteCart', $order->id) }}" class="btn btn-info" name="delete"><i class="fas fa-trash-alt"></i></a>
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
                        <h2 class="card-title-box-cart text-center" >Cart Total</h2>
                        <div class="card-total-cart clearfix" >
                            <span class="totalqty " style="float:left">Total Items:</span>
                            <span class="totalqty " style="float:right">{{$totalqty}}</span>
                        </div>
                        <div class="card-total-bill-cart clearfix " > 
                            <span class="totalbill " style=" float:left">Total Bill:</span>
                            <span class="totalbill " style="float:right">Rp {{number_format($total), 0}}</span>
                        </div>
                        <div class="card-button-cart clearfix" >
                            <a href="{{route('checkoutgan')}}"  class="btn btn-info btn-block " style="float:right">CheckOut</a>
                        </div>   
                    </div>                      
            </div>
    </div>
    <br>
    <h2>Other Product</h2>
    <div class="row" style="padding-bottom:20px">
                
            @if(count($productrandom) > 0)
                @foreach ($productrandom as $row)
                <div class="col-md-4 col-lg-2 col-sm-6 col-12" style="padding-bottom:20px; padding-top:20px; ">
                    <div class=" card-box-detail " >
                        <div style="max-height:80px">
                            <a href="{{route('detailproduct', $row->id)}}"><img class="card-image-random-detail rounded mx-auto d-block img-fluid" style="" src="{{ $row->images[0]->product_image}}"></a>
                        </div>
                        <div class="card-body-detail clearfix" >
                                <div class="card-title-box-detail">
                                    <h6 id="random-title-product-name" class="font-weight-light text-justify" class="text-justify">{{$row->product_name}}</h6>
                                </div>
                            
                                <div class="card-price-box-detail ">
                                    <h6 class="text-center">Rp {{number_format($row->product_price, 0)}}</h6>
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
    
    

<script type="text/javascript">
 
    $(".update-cart").click(function (e) {
       e.preventDefault();

       var ele = $(this);

        $.ajax({
           url: '{{ url('update-cart') }}',
           method: "patch",
           data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
           success: function (response) {
               window.location.reload();
           }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>

@endsection
                                    

    
