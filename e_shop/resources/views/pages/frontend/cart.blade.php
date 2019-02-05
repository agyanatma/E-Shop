@extends('layouts.app')

@section('content')

<div class="container">
        <h1> Cart</h1>
        <div class="row">
            <div class="col-md-8">
                
                @if(count($orders) > 0)
                    @foreach ($orders as $order)
                        @if(Auth::user() && $order->status==0)
                            <div class="col-md-8 card "style="padding-bottom:20px; padding-top:20px; ">
                                    <div class="row">
                                        <div class=" col-md-2">
                                            <a href="{{route('detailproduct', $order->product->id)}}"> <img class="img-fluid" src="{{URL::to('/upload/'.$order->product->images[0]->product_image)}}"> </a>
                                        </div>
                                        <div class="clearfix col-md-5" >
                                            <h6>{{$order->product->category_name}}</h6>
                                            <h6>{{$order->product->product_name}}</h6>
                                            <h6>Rp. {{number_format($order->product->product_price), 0}}</h6>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <h6>Jumlah :{{$order->qty++}}</h6>
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
            <div class="col-md-4 card">
                <h2 class="text-center"> Ringkasan Belanja</h2>
                <div class="text-center"> Total Harga</div>
                <div class="text-center">Rp {{number_format($total), 0}}</div>
                <div class="col-md-12 clearfix">
                    <a href="{{route('checkoutgan')}}" type="button" class="btn btn-block btn-success" style="float:right">CheckOut></a>
                </div>                         
            </div>
    </div>
    <div class="container">
            <div class="row">
                    @if(count($productrandom) > 0)
                        @foreach ($productrandom as $row)
                        <div class="col-md-3" style="padding-bottom:20px; padding-top:20px; ">
                            <div class="card card-box " >
                                <div>
                                    <a href="{{route('detailproduct', $row->id)}}"><img class="card-image rounded mx-auto d-block img-responsive " style="" src="{{ URL::to('/upload/'.$row->images[0]->product_image)}}"></a>
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
                                    

    
