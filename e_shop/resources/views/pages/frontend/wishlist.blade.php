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
    <nav class="navbar-default my-navbar">

        <nav class="navbar navbar-fluid bg-info">
            <div class="row">
                <div class="col-md-2 ">
                    <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                          <h3>Desktop & Mini PC</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 bg-info">
                    <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                    Hardisk & Flashdisk
                        </div>
                    </div>
                </div>
                <div class="col-md-1 bg-info">
                    <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                    VGA Card
                        </div>
                    </div>
                </div>
                <div class="col-md-1 bg-info">
                    <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                    Printer
                        </div>
                    </div>
                </div>
                <div class="col-md-2 bg-info">
                    <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                    Peripheral & Aksesoris
                        </div>
                    </div>
                </div>
                <div class="col-md-2 bg-info">
                    <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                    Networking
                        </div>
                    </div>
                </div>
                <div class="col-md-2 bg-info">
                  <div class="thumbnail">
                        <img src="" alt="..." class="img-responsive">
                        <div class="clearfix">
                    Komponen Komputer
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

</body>
</html>

@endsection

