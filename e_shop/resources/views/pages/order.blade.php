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
    <header>
        <div class="container">
            <h3>Percobaan</h3>
        <nav id="main_nav" style="">
                <ul>
                    <li><a href="/tutorials/">Tutorials</a></li>
                    <li><a href="/techniques/">Techniques</a></li>
                    <li><a href="/examples/">Examples</a></li>
                    <li><a href="/references/">References</a></li>
                </ul>
        </nav>
        </div>
    </header>
<nav class="navbar navbar-default">
        <div class="col-md-3">

          </div>
        <div class="page-header">
            <h2>Bootstrap 4 Sidebar Menu</h2>
        </div>
        <p class="lead">A responsive, multi-level vertical accordion.</p>
        
        <div class="row">
            <div class="col-md-6">
                <button role="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo" aria-expanded="true">
                    horizontal collapsible
                </button>
                <div id="demo" class="width collapse show" aria-expanded="true">
                    <div class="list-group" style="width: 400px;">
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <button role="button" class="btn btn-danger" data-toggle="collapse" data-target="#demo2" aria-expanded="true">
                    vertical collapsible
                </button>
                <div id="demo2" class="height collapse show" aria-expanded="true">
                    <div class="list-group" style="width: 400px;">
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
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