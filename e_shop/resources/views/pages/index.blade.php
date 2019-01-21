@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col float-right">
                <h1>Product</h1>

                    <a href="product/new" class="btn btn-primary" name="create">New Product</a>

            </div>
            @if(Auth::guest())
                <div class="col float-right">
                    <a href="signup" class="btn btn-primary float-right" name="signup">Sign Up</a>
                    <a href="login" class="btn btn-success float-right" name="login">Login</a>
                </div>
            @else
                <div class="col float-right btn-group" style="display: inline">
                    <p>Selamat datang, <a href="{{ route('profile') }}" type="button" name="user">{{$profile->fullname}}</a><p>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                </div>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">User Profile</a>
                    <a class="dropdown-item" href="#">Wishlist</a>
                    <a class="dropdown-item" href="#">Pengaturan</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            @endif
            @if(count($products) > 0)
            <div class="table-responsive">
                <table class="table">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->categories->category_name}}</td>
                            <td>Rp {{$product->product_price}}</h4>
                            <div class="float-right">
                                
                                <form method="POST" action="{{route('deleteProduct', $product->id)}}">
                                    {{csrf_field()}}
                                    <a href="{{'product/'.$product->id.'/edit' }}" class="btn btn-primary" name="edit" value="Edit">Edit</a>
                                    <button type="submit" class="btn btn-primary" name="delete">Delete</button>
                                </form>                                
                            </div> 
                        </tr>
                    @endforeach
                </table>
            </div>
            @else
                <h2>No posts found!</h2>
            @endif
        </div>
    </div>

    
@endsection