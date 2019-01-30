@extends('layouts.app')

@section('content')

<div class="container">
        <h1> Cart</h1>
        <div class="row">
            <div class="col-md-8">
                @if(count($orders) > 0)
                    @foreach ($orders as $order)
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
                                <h6>Jumlah :{{$order->qty}}</h6>
                            </div>
                            <div class="col-md-3 text-center ">
                                <a href="{{ route('deleteCart', $order->id) }}" class="btn btn-info" name="delete"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                        <h3>No posts found!</h3>
                    @endif
            </div>
            <div class="col-md-4 card">
                <h2 class="text-center"> Ringkasan Belanja</h2>
                <div class="text-center"> Total Harga</div>
                <div class="text-center"> Rp{{number_format ($totalharga= $order->product->product_price * $order->qty), 0}}</div>
                <div class="col-md-12 clearfix">
                    <a href="{{route('checkoutgan')}}" type="button" class="btn btn-block btn-success" style="float:right">CheckOut></a>
                </div>                         
            </div>
    </div>
</div>
    <div class="row">
            @if(count($products) > 0)
                @foreach ($products as $product)
                <div class="col-md-3" style="padding-bottom:20px; padding-top:20px; ">
                    <div class="card card-box " >
                        <div>
                            <a href="{{route('detailproduct', $product->id)}}"><img class="card-image rounded mx-auto d-block img-responsive " style="" src="{{ URL::to('/upload/'.$product->images[0]->product_image)}}"></a>
                        </div>
                        <div class="card-body clearfix" >
                                <h6 class="card-title-box">{{$product->product_name}}</h6>
                                <h5 class="card-price-box">Rp {{number_format($product->product_price, 0)}}</h5>
                                <form class="card-text-box-button" method="POST" >
                                    {{csrf_field()}}
                                    <a href="" class="btn btn-info" name="buy"><i class="fas fa-shopping-basket"></i></a>
                                </form>
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
                                    

    
