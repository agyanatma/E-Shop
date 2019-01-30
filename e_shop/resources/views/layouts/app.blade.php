<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="/css/costum1.css">

    <title>{{ config('app.name', 'E-Shop') }}</title>
</head>
<body >
    <header>
   <nav class="navbar navbar-expand-md " >
       <div class="container-fluid">
           <a class="navbar-brand" href="{{ url('/') }}">
               {{ config('app.name', 'E-Shop') }}
           </a>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                   <ul class="navbar-nav ml-auto">
                        <form class="navbar-form" role="search" method="get" action="{{url("/searchcontent")}}">
                                <div class="input-group">
                                    <div class="nav-item" style="margin-right:10px">
                                        <input class="form-control form-control-borderless"  type="search" placeholder="Search topics or keywords" name="title">
                                    </div>
                                    <div class="nav-item" style="margin-right:10px">
                                        <button class="btn btn-info " type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                        </form>
                            @guest
                            <li class="nav-item">
                                    <a class="btn btn-info" style="margin-right:10px" href="{{ route('loginaccountPage') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-info" href="{{ route('registeraccountPage') }}">Register</a>
                            </li>
                            @endguest
                        @if(Auth::user() && session('user_session')->admin==0)
                            <form class="navbar-form" role="search" method="get" action="{{route('cart', $order->id)}}">
                                <div class="input-group">
                                    <div class="nav-item" style="margin-right:10px">
                                        <button class="btn btn-info " type="submit"><i class="fas fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </form>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Auth::user()->fullname}} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('user', $users->id)}}">User Profile</a>
                                    <a class="dropdown-item" href="#">Daftar Belanja</a>
                                    <a class="dropdown-item" href="{{ route('logoutUser') }}">Logout</a>
                                </div>
                            </li>
                        @endif
                        @if(Auth::user() && session('user_session')->admin==1)
                            <form class="navbar-form" role="search" method="get" action="{{route('cart')}}">
                                <div class="input-group">
                                    <div class="nav-item" style="margin-right:10px">
                                        <button class="btn btn-info " type="submit"><i class="fas fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </form>
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Auth::user()->fullname}} (Admin)<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('user', $users->id)}}">User Profile</a>
                                    <a class="dropdown-item" href="#">Daftar Belanja</a>
                                    <a class="dropdown-item" href="/admin/dashboard">Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logoutUser') }}">Logout</a>
                                </div>
                        </li>

                        @endif
                   </ul>
               </div>
       </div>
   </nav>
    </header>
    <script>
$("document").ready(function(){

setTimeout(function(){
    $("div.alert").remove();
}, 3000 );

var quantitiy=0;
$('.quantity-right-plus').click(function(e){
    
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    var quantity = parseInt($('#quantity').val());
    
    // If is not undefined
        
        $('#quantity').val(quantity + 1);

    
        // Increment
    
});

$('.quantity-left-minus').click(function(e){
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    var quantity = parseInt($('#quantity').val());
    
    // If is not undefined

        // Increment
        if(quantity>0){
        $('#quantity').val(quantity - 1);
        }
});

}); 

//animation
        $('div.alert').delay(3000).slideUp(300);

            $(document).ready(function(){
        
                $('.col-md-3').hover(
                    
                    function(){
                        $(this).animate({
                            marginTop: "-=1%",
                        },200);
                    },
        
                function(){
                    $(this).animate({
                        marginTop: "0%"
                    },200);
                }
            );
        });
        </script>
   @yield('content')
   <footer class="align-center">
        <div class="container" >
          <h6 class="m-0 text-center ">Copyright &copy; 2019 - All Rights Reserved -  <a link="codelabs.co.id">Code Labs Indonesia</a></h6>
        </div>
        <!-- /.container -->
    </footer>
   
</body>
</html>
