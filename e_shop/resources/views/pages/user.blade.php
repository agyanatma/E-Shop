@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

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
  <link rel="stylesheet" href="css/app.css">

</head>
<body>
    <nav class="navbar-default my-navbar ">
        <div  class="container-fluid my-container ">
            <div class="panel">
                <div class="panel-header">
                    <div class="jumbotron">
                        <div class="row ">
                          <div class="col-md-3">
                            <img src="https://scontent-lga3-1.cdninstagram.com/vp/0841ad01d271b224ccf41592b9f715dc/5C8C99B1/t51.2885-19/s150x150/31108417_133072260887297_7004721721357893632_n.jpg?_nc_ht=scontent-lga3-1.cdninstagram.com" alt="..." class="img-responsive">
                          </div>
                          <div class="">
                            <h1>Hello, world!</h1>
                        <p>...</p>
                        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                      </div>
                <div class="panel-body">
                    <div class="row my-row">
                        <div class="col-md-1 text-center">
                        </div>
                    </div>

    </nav>
                    <nav aria-label="Page navigation">
                        <ul class="nav nav-pagination nav-justified" >
                            <ul class="pagination">
                    
                                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>                    
                                <li>
                                <a href="#" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                </a>
                              </li>
                            </ul>
                        </div>
                    </nav>
                  </nav>
</body>
</html>

@endsection

