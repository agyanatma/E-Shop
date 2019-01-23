@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form class="form-inline">
                <div class="col-md-6" style="float:left">
                    <h1>Product</h1><br>
                </div>
            </form>
        </div>
        <div class="container-fluid">
                        <div class="row my-row">
                            <div class="col-md-1 text-center">
                                <a href="#" class="list-group-item" ><span style="font-size: 15px; color: Dodgerblack;" class="fas fa-desktop"></span></a>    
                            </div>
                            <div class="col-md-1 text-center ">
                                <a href="#" class="list-group-item" ><span style="font-size: 15px; color: Dodgerblack;" class="fas fa-memory"></span></a> 
                            </div>
                            <div class="col-md-1 text-center ">
                                <a href="#" class="list-group-item" ><span style="font-size: 15px; color: Dodgerblack;" class="fas fa-print"></span></a>
                            </div>
                            <div class="col-md-1 text-center ">
                                <a href="#" class="list-group-item" ><span style="font-size: 15px; color: Dodgerblack;" class="fas fa-keyboard"></span></a>
                            </div>
                            <div class="col-md-1 text-center ">
                                <a href="#" class="list-group-item" ><span style="font-size: 15px; color: Dodgerblack;" class="fas fa-satellite-dish"></span></a>
                            </div>
                            <div class="col-md-1 text-center">
                                    <nav class="btn "><a href="category">
                                        <span style="font-size: 20px; color: Dodgerblack; " class="glyphicon glyphicon-th-large">
                                        </span></a></nav>
                            </div>
                        </div>
          </div>
          <div class="container-fluid">
          <div class="col-6 offset-3 bg-info" >
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
                          </div>
                    </div>
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

