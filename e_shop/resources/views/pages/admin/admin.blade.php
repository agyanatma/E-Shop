@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form class="form-inline">
                    <div class="col-md-6" style="float:left">
                        <h1>Product</h1>
                    </div>
                    <div class="col-md-6" style="float:right">
                        <a href="product/new" class="btn btn-primary" name="create">New Product</a>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                @if(count($products) > 0)
                    <div class="card" style="width:300px">
                        @foreach ($products as $product)
                            <a href="{{route('detailProduct', $product->id)}}"><img class="card-img-top" width="100px" style="text-center" src="{{ URL::to('/upload/'.$product->images[0]->product_image)}}"></a>
                            <div class="card-body">
                                <h4 class="card-title">{{$product->product_name}}</h4>
                                <p class="card-title">{{$product->categories->category_name}}</p>
                                <h3 class="card-text text-right">Rp {{number_format($product->product_price, 0)}}</h3>
                                <form method="POST" action="{{route('deleteProduct', $product->id)}}" style="float:right">
                                    {{csrf_field()}}
                                    <a href="{{'product/'.$product->id.'/edit' }}" class="btn btn-sm btn-primary" name="edit" value="Edit">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-primary" name="delete">Delete</button>
                                </form>                                
                            </div>    
                        @endforeach
                    </div>
                </div>
                @else
                    <h2>No posts found!</h2>
                @endif
            </div>
        </div>
    </div>

    
@endsection