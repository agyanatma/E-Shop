@extends('layout.admin')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6" style="float:left">
            <h1><span class="fas fa-box-open" aria-hidden="true"></span>  Product</h1><br>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th><a href="{{ route('product.new')}}" type="submit" class="btn btn-primary align-middle float-right" style="width:125px">Add Product</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($products) > 0)
                            @foreach ($products as $product)
                            <tr>
                                <td class="align-middle" style="width:80px"><img class="img" style="object-fit:cover" width="50px" height="50px"  src="{{$product->images[0]->product_image}}"></td>
                                <td class="align-middle">{{$product->product_name}}</td>
                                <td class="align-middle">{{$product->categories->category_name}}</td>
                                <td class="align-middle">Rp {{number_format($product->product_price, 0)}}</td>
                                <td class="align-middle" style="width:160px">
                                    <span class="float-right">
                                        <a href="{{ route('editProduct', $product->id) }}" class="btn btn-warning" name="edit">Edit</a>
                                        <a href="{{ route('deleteProduct', $product->id) }}" class="btn btn-danger" name="delete">Delete</a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <h3>No posts found!</h3>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection