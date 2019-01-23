<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/costum1.css">

    <title>{{ config('app.name', 'E-Shop') }}</title>
</head>
<body >
    <header>
   <nav class="navbar navbar-expand-sm " style="margin-bottom: 30px">
       <div class="container-fluid">
           <a class="navbar-brand" href="{{ url('/') }}">
               {{ config('app.name', 'E-Shop') }}
           </a>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                   <ul class="navbar-nav ml-auto">
                               <div class="nav-item" style="margin-right:10px">
                                   <input class="form-control form-control-borderless" type="search" placeholder="Search topics or keywords">
                               </div>
                               <div class="nav-item" style="margin-right:10px">
                                   <button class="btn btn-lg btn-info fas fa-search" type="submit"></button>
                               </div>
                       @if(Auth::user())
                           <li class="nav-item"> 
                               <a class="btn btn-info" style="margin-right:10px" href="#"><i class="fas fa-cart-plus"></i></a>
                           <li class="nav-item dropdown">
                               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   {{$users->fullname}} <span class="caret"></span>
                               </a>
                               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="user">User Profile</a>
                                   <a class="dropdown-item" href="#">Whistlist</a>
                                   <a class="dropdown-item" href="#">Pengaturan</a>
                                   <a class="dropdown-item" href="{{ route('logoutUser') }}">Logout</a>
                               </div>
                           </li>
                       @else
                           <li class="nav-item">
                                   <a class="btn btn-info" style="margin-right:10px" href="{{ route('loginaccountPage') }}">Login</a>
                               </li>
                               <li class="nav-item">
                                   <a class="btn btn-info" style="margin-right:10px" href="{{ route('registeraccountPage') }}">Register</a>
                           </li>
                       @endif
                   </ul>
               </div>
       </div>
   </nav>
    </header>
   @yield('content')
   
   
</body>
</html>
