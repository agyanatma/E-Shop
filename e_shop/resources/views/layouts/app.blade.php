<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/costum1.css">
    
     
    {{-- Costume Alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- table --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>  
    {{-- Image zoom --}}
    <link rel="stylesheet" href="/css/jquery.wm-zoom-1.0.min.css">
    <script src="/js/jquery-1.11.1.js"></script>
    <script src="/js/jquery.wm-zoom-1.0.min.js"></script>

    <script src="/js/prefixfree.min.js"></script>
    <script src="/js/zoom-slideshow.js"></script>
    
    

    <title>{{ config('app.name', 'BukanJakNote') }}</title>
</head>

<header id="header" >
    <nav class="navbar navbar-expand-md navbar-expand-lg navbar-expand-sm navbar-expand-col fixed-top " style="background:#616E7D" >
         <a class="navbar-brand" href="{{ url('/') }}" style=" color:white">
            {{ config('app.name', 'BukanJakNote') }}
        </a>           
        <button class="navbar-toggler form-inline " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-list-ul" style="color:white"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                    <form class="navbar-form form-inline my-2 my-lg-0" role="search" method="get" action="{{url('/searchcontent')}}">
                        <div class="input-group">
                                <input class="form-control form-control-borderless mr-sm-2" type="search" placeholder="Search topics or keywords" name="title">
                                <button class="btn  btn-info " type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                @guest
                    <li class="nav-item  mx-2 my-lg-0 form-inline mx-2">
                        <a class="btn btn-info " href="{{ route('loginaccountPage') }}"><i class="fas fa-sign-in-alt"> Login</i></a>
                    </li>
                    <li class="nav-item mx-0 my-lg-0 form-inline ">
                        <a class="btn btn-info" href="{{ route('registeraccountPage') }}"><i class="fas fa-users"> Register</i></a>
                    </li>
                @endguest
                @if(Auth::check() && Auth::user()->admin==0)
                    <form class="navbar-form form-inline my-2 my-lg-0 text-center" role="cart" method="get" action="{{route('cart')}}">
                            <div class="input-group">
                                
                                    <button class="btn btn-info mx-2 text-center" type="submit">
                                            <i class="fas fa-shopping-cart">
                                                    <div class="quantity-tags-navbar">
                                                        <span >{{$totalorder}}</span>
                                                    </div>
                                            </i>
                                    </button>
                            </div>
                    </form>
                    <li class="nav-item form-inline mx-2 " style="max-height:30px max-width:30px">
                            <img src="{{Auth::User()->profile_image}}" class="card-image-user-header rounded-circle mx-auto d-block img-fluid " >
                    </li>
                    <li class="nav-item dropdown form-inline my-2 my-lg-0 text-center">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{Auth::user()->fullname}} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right my-lg-0" aria-labelledby="navbarDropdown" >
                                <a class="dropdown-item text-center" href="{{route('user', Auth::User())}}"><i class="fas fa-user-cog" ></i> User Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{route('wishlist', Auth::User())}}"><i class="fas fa-heart"></i> Wishlist</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{ route('historyorder',  Auth::User()) }}"><i class="fas fa-history"></i> History Order </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{ route('logoutUser') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </li>
                @endif
                @if(Auth::check() && Auth::user()->admin==1)
                        <form class="navbar-form form-inline my-2 my-lg-0 text-center" role="cart" method="get" action="{{route('cart')}}">
                            <div class="input-group">
                                <div class="nav-item" style="margin-right:10px">
                                    
                                    <button class="btn btn-info mx-2  " type="submit">
                                            <i class="fas fa-shopping-cart">
                                                    <div class="quantity-tags-navbar">
                                                        <span >{{$totalorder}}</span>
                                                    </div>
                                            </i>
                                    </button>
                                   
                                </div>
                            </div>
                        </form>
                        <li  class="nav-item form-inline mx-2 " style="max-height:30px max-width:30px">
                                <img src="{{Auth::User()->profile_image}}" class="card-image-user-header rounded-circle mx-auto d-block img-fluid " >
                        </li>
                         <li  class="nav-item dropdown form-inline my-2 my-lg-0 text-center">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{Auth::user()->fullname}} (Admin)<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right my-lg-0" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-center" href="{{route('user', Auth::User())}}"><i class="fas fa-user-cog" ></i> User Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{route('wishlist', Auth::User())}}"><i class="fas fa-heart"></i> Wishlist</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{ route('historyorder',  Auth::User()) }}"><i class="fas fa-history"> </i> History Order</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="/admin/dashboard"><i class="fas fa-boxes"></i> Dashboard</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="{{ route('logoutUser') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </li>
                @endif
            </ul>
        </div>                   
    </nav>
    </header>
<body >
    
    
<script >
//quantity        
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
        // $('div.alert').delay(3000).slideUp(300);

        //     $(document).ready(function(){
        
        //         $('.col-md-3').hover(
                    
        //             function(){
        //                 $(this).animate({
        //                     marginTop: "-=1%",
        //                 },200);
        //             },
        
        //         function(){
        //             $(this).animate({
        //                 marginTop: "0%"
        //             },200);
        //         }
        //     );
        // });
        </script>
   @yield('content')
   
   
</body>
    <footer class="align-center fixed-bottom">
        <div class="container" >
          <h6 class="m-0 text-center " style="color:white;">Copyright &copy; 2019 - All Rights Reserved -  <a link="bukanjaknote.site">Bukanjaknote.site</a></h6>
        </div>
        <!-- /.container -->
    </footer>
</html>
