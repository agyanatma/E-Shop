@extends('layout.user')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-5">
                    <img src="/upload/{{$product->images[0]->product_image}}" class="border" style="object-fit: cover" width="410" height="400">
                </div>
                <div class="col-md-7">
                    <h2>{{$product->product_name}}</h2>
                    <h4>{{$product->categories->category_name}}</h4><br><br><br><br>
                    <h1>Rp {{number_format($product->product_price, 0)}}</h1>
                    <div class="col-md-4">
                        <div class="input-group">
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
                    </div><br><br><br>
                    <span class="float-right">
                        <a href="" class="btn btn-lg btn-primary">Tambah</a>
                        <a href="" class="btn btn-lg btn-success">Beli Sekarang</a>
                    </span>
                </div>
                <div class="col-md-12">
                    <a href="#"></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection