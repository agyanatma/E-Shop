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
            <a class="navbar-brand text-dark" href="{{ url('/') }}">
                {{ config('app.name', 'E-Shop') }}
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-success" style="margin-right:10px" href="{{ route('loginPage') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="{{ route('registerPage') }}">Register</a>
                            </li>
                        @endguest
                        @if(Auth::user() && session('user_session')->admin==0)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{$users->fullname}} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('profile', $users->id)}}">User Profile</a>
                                    <a class="dropdown-item" href="#">Daftar Belanja</a>
                                    <a class="dropdown-item" href="{{ route('logoutUser') }}">Logout</a>
                                </div>
                            </li>
                        @endif
                        @if(Auth::user() && session('user_session')->admin==1)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{$users->fullname}} (Admin)<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('profile', $users->id)}}">User Profile</a>
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
    @yield('content')
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
</script>
 </body>
 </html>