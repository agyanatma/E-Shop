@extends('layouts.app')

@section('content')

<div class="container-fluid container-detailproduct">
        
            <div class="row row-detail">
            @foreach($products as $product)
                <div class="col-md-5" style="align-items:center;">
                    <div class="card-image-detail">
                        <img class="card-image-detail rounded mx-auto d-block img-responsive" src="/upload/{{$product->images[0]->product_image}}" class="border" >
                    </div>
                </div>
                <div class="col-md-7 clearfix">
                    <div class="card-detail-body">
                        <h2 class="card-detail-name" >{{$product->product_name}}</h2>
                        <h4 class="card-detail-category" >{{$product->categories->category_name}}</h4>
                        <div class="row" >
                            <div class="col-md-5 ">
                                <h2 class="card-detail-price" >Rp {{number_format($product->product_price, 0)}}</h2>
                            </div>
                            <div class="col-md-3 offset-2 ">
                                <div class="input-group card-detail-count">
                                    <span class="input-group-prepend">
                                        <button type="button" class="quantity-left-minus btn btn-info btn-number"  data-type="minus" data-field="">
                                            <span class="fas fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" width="200px" name="quantity" class="form-control input-number" value="0" min="1" max="100">
                                    <span class="input-group-append">
                                        <button type="button" class="quantity-right-plus btn btn-info btn-number" data-type="plus" data-field="">
                                            <span class="fas fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix card-detail-button" >
                            <a href="" class="btn btn-lg btn-primary"><i class="fas fa-cart-plus"></i> Tambah Keranjang</a>
                            <a href="" class="btn btn-lg btn-success"><i class="fas fa-money-bill"></i> Beli Sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-1" >
                    <div class="card card-detail-description">
                    <p>{{$product->description}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    
@endsection