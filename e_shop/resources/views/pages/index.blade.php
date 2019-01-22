@extends('layout.user')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="form-inline">
                    <div class="col-md-6" style="float:left">
                        <h1>Product</h1><br>
                    </div>
                </form>
            </div>
            <div class="container">
                <div class="row">
                    @if(count($products) > 0)
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <div class="card" style="width:300px">
                                    <a href="{{route('detailProduct', $product->id)}}"><img class="card-img-top" width="100px" style="text-center" src="{{ URL::to('/upload/'.$product->images[0]->product_image)}}"></a>
                                        <div class="card-body">
                                            <h4 class="card-title">{{$product->product_name}}</h4>
                                            <p class="card-title">{{$product->categories->category_name}}</p>
                                            <h3 class="card-text text-right">Rp {{number_format($product->product_price, 0)}}</h3>
                                            <form method="POST"  style="float:right; margin: 5px 0px;">
                                                {{csrf_field()}}
                                                <a href="#" class="btn btn-primary" name="buy">Add to Cart</a>
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
            </div>
        </div>
    </div>

    
@endsection