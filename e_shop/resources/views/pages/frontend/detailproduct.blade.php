@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="/upload/{{$products->images[0]->product_image}}" class="border" style="object-fit: cover" width="410" height="400">
                @foreach($images as $item)
                    <img src="/upload/{{$item->product_image}}" class="border" style="object-fit: cover; margin-top:10px" width="80" height="80">
                @endforeach
            </div>
        
            <div class="col-md-7">
                <h2>{{$products->product_name}}</h2>
                <h4>{{$products->categories->category_name}}</h4><br><br><br><br>
                <h1>Rp {{number_format($products->product_price, 0)}}</h1>
                <div class="row row-centered">
                    <div class="col-md-8" style="padding-top:20px">
                        <form action="{{route('addCart')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row ">
                                <div class="input-group-prepend col-md-4 " style="padding-bottom:20px"> 
                                        <button type="button" class="quantity-left-minus btn btn-info btn-number"  data-type="minus" data-field="">
                                            <span class="fas fa-minus"></span>
                                        </button>
                                    <input type="text" id="quantity" width="200px" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                        <button type="button" class="quantity-right-plus btn btn-info btn-number" data-type="plus" data-field="">
                                            <span class="fas fa-plus"></span>
                                        </button>
                                </div>
                                <div class="form-group col-md-8" style=" padding-left:150px">
                                <input type="hidden" name="user_id" value="{{$users->id}}">
                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                <input type="hidden" name="product_price" value="{{$products->product_price}}">
                                <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4" style="x">
                            <div class="col-md-12 clearfix">
                                    <a href="{{route('checkoutgan')}}" type="button" class="btn btn-block btn-success" style="float:right">CheckOut></a>
                                </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <p>{{$products->description}}></p>
                </div>
            </div>
        </div>
    </div>
@endsection