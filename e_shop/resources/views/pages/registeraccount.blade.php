
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
  <link rel="stylesheet" href="css/costum.css">


</head>
<body>
    @if(count($errors)>0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif
<nav class="navbar-default ">
    <div class="container-fluid">
        <div class="panel">
            <div class="panel-body">
                    <div class="row">
                            <div class="col-md-6 text-center">
                                <nav class="navbar">
                                    <div class="container-fluid">
                                            <!-- Brand and toggle get grouped for better mobile display -->
                                            <!-- Collect the nav links, forms, and other content for toggling -->
                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                <div id="carousel-example-generic" class="carousel slide carousel img" data-ride="carousel">
                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                  <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                  <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                                </ol>
                                              
                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                  <div class="item active">
                                                    <img class="img-responsive img-center" class="carousel" src="https://source.unsplash.com/featured/view" alt="...">
                                                    <div class="carousel-caption">
                                                      ...
                                                    </div>
                                                  </div>
                                                  <div class="item">
                                                    <img class="img-responsive img-center " class="carousel" src="https://source.unsplash.com/featured/landscape" alt="...">
                                                    <div class="carousel-caption">
                                                      ...
                                                    </div>
                                                  </div>
                                                  <div class="item">
                                                      <img  class="img-responsive img-center" class="carousel" src="https://source.unsplash.com/featured/architecture" alt="...">
                                                      <div class="carousel-caption">
                                                        ...
                                                      </div>
                                                  </div>
                                                </div>
                                              
                                                <!-- Controls -->
                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                  <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                  <span class="sr-only">Next</span>
                                                </a>
                                              </div>
                                            </div><!-- /.navbar-collapse -->
                                          </div><!-- /.container-fluid -->
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group ">
                                    <h3 class="text-center">Sign Up</h3>
                                    <form action="{{route('store.signup')}}" method="post" class="container" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        
                                        <label>Email:</label>
                                        <input type="email" class="form-control" name="email" placeholder="example@mail.com">
                                        <br/>
                                        <label>Password:</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        <br/>
                                        <label>Nama:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Nama">
                                        <br/>
                                        <label>Alamat:</label>
                                        <input type="text" class="form-control" name="address" placeholder="Alamat">
                                        <br/>
                                        <label>Kota:</label>
                                        <input type="text" class="form-control" name="city" placeholder="Kota">
                                        <br/>
                                        <label>Kode Pos:</label>
                                        <input type="text" class="form-control" name="postal" placeholder="Kode Pos">
                                        <br/>
                                        <label>Profile Picture:</label><br/>
                                        <input type="file" name="img">
                                        <br/>
                                        <br/>
                                        <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Sign Up</button>
                                        
                                    </form>
                                    </div>
                                </div>
                    </div>
            </div>
        </div>
    </div>
</nav>
</body>
@endsection