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

     <title>{{ config('app.name', 'E-Shop') }}</title>
 </head>
 <body>
    <nav class="navbar navbar-expand-sm bg-dark" style="margin-bottom: 30px">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'E-Shop') }}
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @if(Auth::user())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{$users->fullname}} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">User Profile</a>
                                    <a class="dropdown-item" href="#">Daftar Belanja</a>
                                    <a class="dropdown-item" href="{{ route('logoutUser') }}">Logout</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                    <a class="btn btn-success" style="margin-right:10px" href="{{ route('loginPage') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ route('registerPage') }}">Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
        </div>
    </nav>
    @yield('content')
<script>
    $('div.alert').delay(3000).slideUp(300);
</script>
 </body>
 </html>