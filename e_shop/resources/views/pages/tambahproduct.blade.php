@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E_Shop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
@if(count($errors)>0)
<ul>
    @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{$error}}</li>
    @endforeach
</ul>
@endif
<body>
    <nav class="navbar-default my-navbar">
        <nav class="navbar-default my-navbar">
            <div  class="container-fluid my-container ">
              <div class="row my-row">
                  <div class="col-md-2">
                      <ul class="nav navbar-nav navbar-left">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link active" href="user"><span style="font-size: 15px; color: Dodgerblue;" class="navbar-navbar-navbar-brand fas fa-users"> USER</span></a></li>
                                    <li class="nav-item"><a class="nav-link active" href="shop"><span style="font-size: 15px; color: Dodgerblue;" class="navbar-navbar-navbar-brand fas fa-shopping-basket"> PRODUK</span></a></li>
                                    <li class="nav-item"><a href="#menu1" class="nav-link active" data-toggle="collapse" data-parent="#sidebar" aria-expanded="true"><span style="font-size: 15px; color: Dodgerblue;" class=" fa fa-dashboard"> Kategori <i class="fas fa-caret-down"></i></span></a></li>
                                            <div class="collapse" id="menu1">
                                                <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Optical Drive</a>
                                                <div class="collapse" id="menu1sub1"></div>
                                                <a href="#" class="list-group-item" data-parent="#menu1">Desktop & Mini PC</a>
                                                <a href="#" class="list-group-item" data-parent="#menu1">Hardisk & Flashdisk</a>
                                                <a href="#" class="list-group-item" data-parent="#menu1">VGA Card</a>
                                                <a href="#" class="list-group-item" data-parent="#menu1">Printer</a>
                                                <a href="#" class="list-group-item" data-parent="#menu1">Peripheral & Aksesoris</a>
                                                <a href="#" class="list-group-item" data-parent="#menu1">Networking</a>
                                                <a href="#" class="list-group-item" data-parent="#menu1">Komponen Komputer</a>
                                            </div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link active" href="wishlist"><span style="font-size: 15px; color: Dodgerblue;" class="navbar-navbar-navbar-brand fas fa-cart-plus"> Wishlist</span></a></li>
                                </ul>
                            </ul>
                </div>
                <div class="col-md-10 ">
                    <div class="form-group container">
                            <form action="{{route('product.create')}}" method="post" class="container" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fas fa-box"></i></span>
                                    <input  type="text" class="form-control" id="product_name" name="product_name" value="@yield('editName')" placeholder="Produk">
                                </div>
                        
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></i></span>
                                    <input type="text" class="form-control" name="product_price" value="@yield('editPrice')" placeholder="Harga">
                                </div>
                        
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <select name="category_name">
                                           @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                        
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="far fa-image"></i></span>
                                    <input type="file" name="img[]" multiple>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-primary" style="float: right" name="create" value="Create">
                            </form>
                    </div>
                </div>
            </div>
        </div>
        
    </nav>

</body>
</html>

@endsection

