@extends('layouts.app')

@section('content')
<div class="container">
        <br>
        <h1> Cart</h1>
        <br>
        <div class="row">
            <div class="col-md-8">
                @if(count($orders) > 0)
                    @foreach ($orders as $order)
                        @if(Auth::user() && $order->status==0)
                            <div class="col-md-8 card "style="padding-bottom:20px; padding-top:20px; ">
                                    <div class="row">
                                        <div class=" col-md-2">
                                            <a href="{{route('detailproduct', $order->product->id)}}"> <img class="img-fluid" src="{{$order->product->images[0]->product_image}}"> </a>
                                        </div>
                                        <div class="clearfix col-md-5" >
                                            <h6 class="text-justify">{{$order->product->category_name}}</h6>
                                            <h6 class="text-justify">{{$order->product->product_name}}</h6>
                                            <h6 class="text-justify">Rp. {{number_format($order->product->product_price), 0}}</h6>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <h6 class="text-justify">Items :{{$order->qty}}</h6>
                                        </div>
                                        <div class="col-md-3 text-center ">
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
            <div class="col-md-4 card fixed">
                <h2 class="text-center">Shopping Summary</h2>
                <h4 class="text-center"> Total Items :  {{$totalqty}}</h4>
                <div class="text-center"> Total Bill</div>
                <div class="text-center">Rp {{number_format($total), 0}}</div>
                <div class="col-md-12 clearfix">
                    <a href="{{route('checkoutgan')}}"  class="btn btn-info btn-block " style="float:right">CheckOut></a>
                </div>                         
            </div>
    </div>
<br>
<h1> Random Product</h1>
<div class="row" style="padding-bottom:20px">
        @if(count($productrandom) > 0)
            @foreach ($productrandom as $row)
            <div class="col-md-6 col-lg-3 col-sm-8 col-12" style="padding-bottom:20px; padding-top:20px; ">
                <div class=" card-box-cart " >
                    <div style="max-height:100px">
                        <a href="{{route('detailproduct', $row->id)}}"><img class="card-image-random-cart rounded mx-auto d-block img-responsive " style="object-fit:cover; " src="{{ $row->images[0]->product_image}}"></a>
                    </div>
                    <div class="card-body-cart clearfix" >
                            <div class="card-title-box-cart">
                                <h6 id="random-title-product-name" class="font-weight-light text-justify" class="text-justify">{{$row->product_name}}</h6>
                            </div>
                        
                            <div class="card-price-box-cart">
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
    {{-- <div class="fixed-size-container">
        @if(count($productrandom) > 0)
            @foreach ($productrandom as $row)
                <div class="fixed-size col-md-2">
                    <div>
                         <a href="{{route('cartproduct', $row->id)}}"><img class="card-image rounded mx-auto d-block img-responsive " style="" src="{{ $row->images[0]->product_image}}"></a>
                    </div>
                    <div class="card-body clearfix" >
                            <h6 class="cart-title-box">{{$row->product_name}}</h6>
                            <h5 class="card-price-box">Rp {{number_format($row->product_price, 0)}}</h5>
                            @if(Auth::check() && Auth::user())
                            <form action="{{route('addcartlangsung', ['id'=> $row->id])}}" class="card-text-box-button" method="POST" >
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{$users->id}}">
                                <input type="hidden" name="product_id" value="{{$row->id}}">
                                <input type="hidden" name="product_price" value="{{$row->product_price}}">
                            <input type="hidden" name="qty" value="1" id="">
                                <button type="submit" id="cartBtn" class="btn btn-info"><i class="fas fa-shopping-basket"></i></button>
                            </form>
                            @else
                            <a href="/loginaccount" id="cartBtn" class="btn btn-info"><i class="fas fa-shopping-basket"></i></a>
                            @endif
                    </div>
                </div>
            @endforeach
        @else
            <h2>No posts found!</h2>
        @endif
    </div> --}}
       
    
    {{-- <div class="container">
            <div class="row">
                    @if(count($productrandom) > 0)
                        @foreach ($productrandom as $row)
                        <div class="col-md-2" style="padding-bottom:20px; padding-top:20px; ">
                            <div class="card card-box " >
                                <div>
                                    <a href="{{route('cartproduct', $row->id)}}"><img class="card-image rounded mx-auto d-block img-responsive " style="" src="{{ $row->images[0]->product_image}}"></a>
                                </div>
                                <div class="card-body clearfix" >
                                        <h6 class="card-title-box">{{$row->product_name}}</h6>
                                        <h5 class="card-price-box">Rp {{number_format($row->product_price, 0)}}</h5>
                                        @if(Auth::check() && Auth::user())
                                        <form action="{{route('addcartlangsung', ['id'=> $row->id])}}" class="card-text-box-button" method="POST" >
                                            {{csrf_field()}}
                                            <input type="hidden" name="user_id" value="{{$users->id}}">
                                            <input type="hidden" name="product_id" value="{{$row->id}}">
                                            <input type="hidden" name="product_price" value="{{$row->product_price}}">
                                        <input type="hidden" name="qty" value="1" id="">
                                            <button type="submit" id="cartBtn" class="btn btn-info"><i class="fas fa-shopping-basket"></i></button>
                                        </form>
                                        @else
                                        <a href="/loginaccount" id="cartBtn" class="btn btn-info"><i class="fas fa-shopping-basket"></i></a>
                                        @endif
                                </div>

                            </div>
                        </div>
                            @endforeach
                           
                            
                        @else
                            <h2>No posts found!</h2>
                        @endif
            </div>
    </div> --}}
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
                                    

    
