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
    <fieldset>
        <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input  type="text" class="form-control" id="username" name="username" placeholder="Username" required="">
        </div>

        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fas fa-mail-bulk"></i></span>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" required="">
        </div>

        <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input class="form-control" placeholder="Password" id="password" name="password" type="password" required="">
        </div>

        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" required="">
        </div>

        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fas fa-address-card"></i></i></span>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required="">
        </div>
        
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fas fa-city"></i></span>
            <input type="text" class="form-control" id="city" name="city" placeholder="City" required="">
        </div>

        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" id="postal-code" name="postal-code" placeholder="Postal Code" required="">
        </div>

        <!-- Change this to a button or input when using this as a form -->
        <button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-hand-o-right"></i> Login <i class="fa fa-hand-o-left"></i></button>
       
    </fieldset>
</nav>
</body>
</html>

@endsection

