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
<body>

    <nav class="navbar navbar-default">
        <div class="container">
            <div class="row">
                <div class="col-md-2 bg-danger">
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
                <div class="col-md-10 bg-info">
                        <fieldset>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fas fa-box"></i></span>
                                    <input  type="text" class="form-control" id="product" name="product" placeholder="Nama Produk" required="">
                                </div>
                        
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></i></span>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Harga" required="">
                                </div>
                        
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input class="form-control" placeholder="Katagori" id="category" name="category" type="category" required="">
                                </div>
                        
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="far fa-image"></i></span>
                                    <input class="form-control" placeholder="Image" id="image" name="image" type="image" required="">
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block"> Upload</button>
                               
                            </fieldset>
                </div>
            </div>
        </div>
        
    </nav>

</body>
</html>

@endsection

