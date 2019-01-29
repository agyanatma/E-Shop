@extends('layouts.app')

@section('content')

<div class="container-fluid my-container">
        <div style="padding:50px" >
                <div class="card-fluid bg-white" >
                    <div class="row row-centered" style="padding:20px ">
                        <div class="col-md-2 ">
                            <a href="sortheadphone"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[10]->category_image}}"></a>
                        </div>
                        <div class="col-md-2">
                            <a href="sortkeyboard"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[2]->category_image}}"></a>
                        </div>
                        <div class="col-sm-2">
                            <a href="sortleptop"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[11]->category_image}}"></a>
                        </div>
                        <div class="col-md-2">
                            <a href="sortmonitor"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[0]->category_image}}"></a>
                        </div>
                        <div class="col-md-2">
                            <a href="sortprocessor"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[3]->category_image}}"></a>
                        </div>
                        <div class="col-md-2" >
                            <a href="lainlain"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;" src="upload/lain-lain.png"></a>
                        </div>
                    </div>
                </div>
            <div class="container-fluid my-container ">
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
        </div>
</div>
        

@endsection

