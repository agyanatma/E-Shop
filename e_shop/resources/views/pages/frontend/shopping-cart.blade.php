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
                            @if(count($orders) > 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <td style="width:30px"><img class="img-fluid" src="{{ URL::to('/upload/'.$product->images[0]->product_image)}}"></td>
                                    <h6>{{$order->product->category_name}}</h6>
                                <h6>{{$order->product->product_name}}</h6>
                                <h6>Rp. {{number_format($order->product->product_price), 0}}</h6>
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
                <h1>Total : RP.{{number_format($totalPrice)}}</h1>
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
                                    

    
