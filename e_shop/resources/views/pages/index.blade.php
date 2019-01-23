@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Category</h1><br>
            </div>
            <div class="col-sm-2">
                <a href="#"><img class="img-thumbnail" width="500px" src="/upload/{{$categories[0]->category_image}}"></a>
            </div>
            <div class="col-sm-2">
                <a href="#"><img class="img-thumbnail" width="500px" src="/upload/{{$categories[0]->category_image}}"></a>
            </div>
            <div class="col-sm-2">
                <a href="#"><img class="img-thumbnail" width="500px" src="/upload/{{$categories[0]->category_image}}"></a>
            </div>
            <div class="col-sm-2">
                <a href="#"><img class="img-thumbnail" width="500px" src="/upload/{{$categories[0]->category_image}}"></a>
            </div>
            <div class="col-sm-2">
                <a href="#"><img class="img-thumbnail" width="500px" src="/upload/{{$categories[0]->category_image}}"></a>
            </div>
            <div class="col-sm-2">
                <a href="#"><img class="img-thumbnail" width="500px" src="/upload/{{$categories[0]->category_image}}"></a>
            </div>
            <div class="col-md-12" style="margin-top: 50px">
                <h1>Product</h1>
            </div>
            <div class="col-lg-12">
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

