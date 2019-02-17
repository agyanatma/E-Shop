<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/r-2.2.2/datatables.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>{{ config('app.name', 'E-Shop') }}</title>
</head>
<body>
    @if(Auth::user())
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
                                {{Auth::user()->fullname}} <span class="fas fa-crown"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/">Homepage</a>
                                <a class="dropdown-item" href="/admin/product">Product Index</a>
                                <a class="dropdown-item" href="/admin/category">Category Index</a>
                                <a class="dropdown-item" href="/admin/order">Order Index</a>
                                <a class="dropdown-item" href="/logout">Logout</a>
                            </div>
                        </li>
                   </ul>
               </div>
       </div>
   </nav>
    @endif
    <div class="container">
        @if (session('status'))
            <p class="alert alert-success">{{ session('status') }}</p>
        @elseif (session('failed'))
            <p class="alert alert-danger">{{ session('failed') }}</p>
        @elseif(count($errors)>0)
            <p class="alert alert-danger">{{$errors->first()}}</p>
        @endif
    </div>
    @yield('content')
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

    <script>
    $("document").ready(function(){
    setTimeout(function(){
        $("p.alert").slideUp(500);
    }, 2000 ); 
    }); 
    </script>
    
    @stack('scripts')
</body>
</html>