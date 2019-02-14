@extends('layouts.app')

@section('content')


<div class="container-fluid" style=""> 
    <h2 class="title-cart text-center" style="margin:50px 0 20px 0;  padding-bottom:20px" >Your Shopping Cart</h2>
    <div class="card-total-cart text-center clearfix" style="border-bottom: solid 1px #e0e0e0;">
            <strong class="totalqty " >Total Items</strong>
            <strong class="totalqty ">({{$totalqty}})</strong>
    </div>
    <div style="padding:20px">
        <div class="card-box-cart-table-header table-bordered "style="padding-bottom:20px; padding-top:20px;background-color: #f2f2f2 " >
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-5 text-center"  >
                        <strong class="text-center">Product</strong> 
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center">
                        <strong class="text-center">Quantity</strong>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 text-center">
                        <strong class="text-center">Total</strong>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 text-center ">
                        <strong  class="text-center">Remove</strong>
                    </div>                            
                </div>
        </div>
        @if(count($orders) > 0)
            @foreach ($orders as $order)
                @if(Auth::user() && $order->status==0)
    <div >
        <div class="card-box-cart-table-body table-bordered " style="padding-bottom:40px; padding-top:40px; " >
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-2 table-data text-center" style="max-height:100px">
                    <a href="{{route('detailproduct', $order->product->id)}}"><img class="img-fluid card-image-cart-table " style="margin-left:20px" src="{{$order->product->images[0]->product_image}}"> </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 table-data text-center" >
                    <strong class="text-center">{{$order->product->product_name}}</strong>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-2 table-data text-center">
                    <strong class="text-center">{{$order->qty}}</strong>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 table-data text-center">
                    <strong class=" text-center">Rp.{{number_format($order->qty * $order->product->product_price), 0}}</strong>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-2 table-data text-center " style="">
                    <a href="{{ route('deleteCart', $order->id) }}" class="btn  " style="color:red" name="delete"><i class="fas fa-times"></i></a>
                </div>                            
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
        <div class=" card-title-box-cart" style="border-bottom: solid 1px #e0e0e0;">
            <h3 class=" text-right text-uppercase" ><em>Sub Total</em></h3>
        </div>
        <div class="card-total-bill-cart text-right" style="padding-bottom:20px;">
            <strong class="totalbill " style="font-size:25px;">Rp.{{number_format($total), 0}}</strong>
        </div>
        <div class="">
            <div class="row justify-content-end">
                <div class="card-button-cart-continue col-lg-4 col-md-4 col-sm-4 col-4 " >
                    <a href="{{route('userPage')}}"  class="btn btn-info btn-block" >Continue Shopping</a>
                </div>
                <div class="card-button-cart-checkout col-lg-4 col-md-4 col-sm-4 col-4" >
                    <a href="{{route('checkoutgan')}}"  class="btn btn-info btn-block" >Checkout</a>
                </div>  
            </div>
        </div> 
    </div>        
</div>
   
    <h2 style="margin-top:100px; margin-left:20px;">Other Product</h2>
    <div class="row" style="padding:20px">
                
            @if(count($productrandom) > 0)
                @foreach ($productrandom as $row)
                <div class="col-md-4 col-lg-2 col-sm-6 col-12" style="padding-bottom:20px; padding-top:20px; ">
                    <div class=" card-box-cart " >
                        <div style="max-height:120px">
                            <a href="{{route('detailproduct', $row->id)}}"><img class="card-image-random-cart rounded mx-auto d-block img-fluid" style="" src="{{ $row->images[0]->product_image}}"></a>
                        </div>
                        <div class="card-body-cart clearfix" >
                                <div class="card-title-box-cart">
                                    <h6 id="random-title-product-name" class="font-weight-light text-center" class="text-justify">{{$row->product_name}}</h6>
                                </div>
                                <div class="card-price-box-cart ">
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
                                    

    
