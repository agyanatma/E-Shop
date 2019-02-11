@extends('layout.user')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th></th>
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
                                    <td><a href="{{route('detailProduct', $product->id)}}" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <h3>No posts found!</h3>
                            @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h2>Total Harga</h2>

            </div>
            
        </div>
    </div>

    
@endsection