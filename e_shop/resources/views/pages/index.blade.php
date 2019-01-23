@extends('layouts.app')

@section('content')
<div class="container-fluid my-container">
        <div style="padding:50px" >
                <div class="card-fluid bg-white" >
                    <div class="row">
                        <div class="col-md-2 text-center">
                                <a href="#"><img style="height:100px;" class="rounded mx-auto d-block img-responsive img-fluid max-width:100px" src="http://ichef.bbci.co.uk/news/976/cpsprodpb/12787/production/_95455657_3312a880-230e-474c-b1d9-bb7c94f8b00e.jpg" alt="..."></a>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                        @if(count($products) > 0)
                            @foreach ($products as $product)
                            <div class="col-md-3" style="padding-bottom:20px; padding-top:20px; ">
                                <div class="card"style="height:300px" >
                                    <div class="crop">
                                        <a href="{{route('detailProduct', $product->id)}}"><img class="rounded mx-auto d-block img-responsive img-fluid " style="height: 100px; max-width: 100%; display: block;" src="{{ URL::to('/upload/'.$product->images[0]->product_image)}}"></a>
                                    </div>    
                                        <div class="card-body" style="">
                                                <h4 class="card-title text-left">{{$product->product_name}}</h4>
                                                <p class="card-title text-left">{{$product->categories->category_name}}</p>
                                                <h3 class="card-text-fluid text-right">Rp {{number_format($product->product_price, 0)}}</h3>
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

        <div class="container-fluid ">
            <div class="col-md-4 offset-4">
            <ul class="pagination ">
                    <li class="page-item disabled">
                      <a class="page-link" href="#">&laquo;</a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">4</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">5</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">&raquo;</a>
                    </li>
            </ul>
            </div>    
        </div>   

          


      
</body>
</html>

@endsection

