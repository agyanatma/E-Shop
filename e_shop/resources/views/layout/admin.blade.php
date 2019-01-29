<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <title>{{ config('app.name', 'E-Shop') }}</title>
</head>
<body>
   <nav class="navbar navbar-expand-sm bg-light" style="margin-bottom: 30px">
       <div class="container">
           <a class="navbar-brand text-dark" href="{{ url('/admin/dashboard') }}">
               {{ config('app.name', 'E-Shop') }}
           </a>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <ul class="navbar-nav mr-auto">
                       
                   </ul>
                   <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{$users->fullname}} (Admin) <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/">Homepage</a>
                                <a class="dropdown-item" href="/admin/product">Product Index</a>
                                <a class="dropdown-item" href="/admin/category">Category Index</a>
                                <a class="dropdown-item" href="#">Order Index</a>
                                <a class="dropdown-item" href="#">User Index</a>
                                <a class="dropdown-item" href="{{ route('logoutUser') }}">Logout</a>
                            </div>
                        </li>
                   </ul>
               </div>
       </div>
   </nav>
   @yield('content')
<script>
   $("document").ready(function(){
   setTimeout(function(){
       $("div.alert").slideUp(500);
   }, 2000 ); 
   }); 
</script>
</body>
</html>