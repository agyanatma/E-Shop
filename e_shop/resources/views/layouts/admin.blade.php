<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.18/r-2.2.2/datatables.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <title>{{ config('app.name', 'BukanJakNote') }}</title>
</head>

<body style="background-color:#F4F4F4">
    <div class="sidenav text-center">
        <a href="/admin/dashboard" class="fas fa-home fa-2x" style="padding:1px 8px 60px 8px"></a>
        <a href="/admin/product" class="fas fa-box-open fa-2x" aria-hidden="true"></a>
        <a href="/admin/category" class="fas fa-clipboard-list fa-2x" aria-hidden="true"></a>
        <a href="/admin/order" class="fas fa-dolly-flatbed fa-2x" aria-hidden="true"></a>
        <a href="/admin/user" class="fas fa-users fa-2x" aria-hidden="true"></a>   
    </div>

    <div class="main">
        @if(Auth::user())
            <nav class="navbar navbar-expand-sm" style="height:70px; background-color:#344955">
                <div class="container-fluid">
                    <h3 class="text-white"><i class="fas fa-cog text-white"></i> Dashboard</h3>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        <div class="container-fluid" style="posisition:fixed">
            @if (session('status'))
                <p class="alert alert-success">{{ session('status') }}</p>
            @elseif (session('failed'))
                <p class="alert alert-danger">{{ session('failed') }}</p>
            @elseif(count($errors)>0)
                <p class="alert alert-danger">{{$errors->first()}}</p>
            @endif
        </div>
        @yield('content')
    </div>
    
    
    
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

    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }  
    </script>
    
    @stack('scripts')
</body>
</html>