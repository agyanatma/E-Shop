@extends('layouts.app')

@section('content')

    <div class="container">
        @if (Session::has('cart'))
        <div class="row">
            <div class="col-md-12">
                    
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if(count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td style="width:30px"><img class="img-fluid" src="{{ URL::to('/upload/'.$product->images[0]->product_image)}}"></td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->categories->category_name}}</td>
                                    <td>Rp {{number_format($product->product_price, 0)}}</td>
                                    <td> <span class="badge">{{$product['qty']}}</span></td>
                                    <td><a href="{{route('detailproduct', $product->id)}}" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
                
            <div class="col-md-12">
                <h1>Total : {{$totalPrice}}</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('checkoutCart')}}" type="button" class="btn btn-success" style="float:right">CheckOut</a>
            </div>
        </div>

    </div>
    @else
    <h3>No posts found!</h3>
@endif
@endif
@endsection
                                    

    
