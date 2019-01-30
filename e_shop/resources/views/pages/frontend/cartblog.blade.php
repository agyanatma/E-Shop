@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="form-inline">
                    <div class="col-md-6" style="float:left">
                        <h1>Product</h1><br>
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
                </form>
            </div>
            <div class="container">
                <div class="row">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection