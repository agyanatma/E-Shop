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
<nav class="navbar-default my-navbar">
    <nav class="navbar-default my-navbar">
        <div  class="container-fluid my-container ">
          <div class="row my-row">
              <div class="col-md-2">
                  <ul class="nav navbar-nav navbar-left">
                      <ul class="nav flex-column">
                          <li class="nav-item"><a class="nav-link active" href="user"><span style=" font-size: 15px; color: Dodgerblue;" class="fa fa-user"> USER</span></a></li>
                          <li class="nav-item"><a class="nav-link active" href="shop"><span style="font-size: 15px; color: Dodgerblue;" class="navbar-navbar-brand fa fa-shopping-basket"> PRODUK</span></a></li>
                          <li class="nav-item"><a class="nav-link active" href="category"><span style="font-size: 15px; color: Dodgerblue;" class="navbar-navbar-navbar-brand fa fa-dashboard"> Kategori</span></a></li>
                          <li class="nav-item"><a class="nav-link active" href="wishlist"><span style="font-size: 15px; color: Dodgerblue;" class="navbar-navbar-navbar-brand fa fa-cart-plus"> Wishlist</span></a></li>
                      </ul>
                  </ul>
              </div>
              <div class="col-md-10">
                  <div class="col-6 offset-3"  class="container-fluid">
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
                          <div  class="carousel-inner" role="listbox">
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
                    <div></div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                          <div class="thumbnail">
                            <img src="http://2.bp.blogspot.com/-_3bQHA23wMU/Uq99mvNNmqI/AAAAAAAAAaE/ORv3_Q3rqwI/s1600/Pengertian-dan-Definisi-Komputer-Menurut-Para-Ahli.jpg " alt="..." class="img-responsive">
                            <div class="clearfix">
                              <h3>Komputer</h3>
                              <div class="pull-left price">Rp.1.900.000</div>
                              <p><a href="tambahproduct" class="btn btn-success pull-right" role="button">Add to Cart</a></p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                              <img src="http://butikdukomsel.com/41675-large_default/infinix-hot-s3x-332gb-lte.jpg" alt="..." class="img-responsive">
                              <div class="clearfix">
                                <h3>SAMSUNG </h3>
                                <div class="pull-left price">Rp.1.900.000</div>
                                <p><a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                              <img src="http://www.artikel-indonesia.com/wp-content/uploads/2013/06/Lemari-Es.jpg" alt="..." class="img-responsive">
                              <div class="clearfix">
                                <h3>Lemari Es</h3>
                                <div class="pull-left price">Rp.4.000.000</div>
                                <p><a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-4">
                              <div class="thumbnail">
                                <img src="https://ecs7.tokopedia.net/img/cache/700/product-1/2017/1/26/15866466/15866466_3bd32d6b-f221-452a-b9e6-064e8751bb7e_600_600.jpg" alt="..." class="img-responsive">
                                <div class="clearfix">
                                  <h3>Kipas Angin</h3>
                                  <div class="pull-left price">Rp.430.000</div>
                                  <p><a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                  <img src="http://ciricara.com/wp-content/uploads/2014/01/28/setrika.jpg" alt="..." class="img-responsive">
                                  <div class="clearfix">
                                    <h3>Setrika</h3>
                                    <div class="pull-left price">Rp.200.000</div>
                                    <p><a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a></p>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                  <img src="https://cdns.klimg.com/dream.co.id/resized/750x500/news/2018/03/08/79230/cari-tahu-masa-expired-alat-elektronik-rumah-tangga-180308w_3x2.jpg" alt="..." class="img-responsive">
                                  <div class="clearfix">
                                    <h3>Mesin Cuci</h3>
                                    <div class="pull-left price">Rp.1.000.0000</div>
                                    <p><a href="#" class="btn btn-success pull-right" role="button">Add to Cart</a></p>
                                  </div>
                                </div>
                              </div>
                    </div>
    
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

      
</body>
</html>

@endsection

