@extends('layouts.app')

@section('content')
    <div class="container-fluid my-container">
        
        <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 bg-info">
                        <img class="img-responsive" style=" max-width: 100%; max-height: 300px;" src="https://cdn.sindonews.net/dyn/620/content/2015/04/21/123/992187/peminat-komputer-pc-turun-70-Bia.jpg" >
                    </div>
                    <div class="col-md-4 bg-danger">
                        <h3>Produk</h3>
                        <h5>Kategori</h5>
                        <br>
                        <h5>Harga</h5>
                    </div>
                    <div class="col-md-4 bg-warning">
                        <select type="text" class="form-control" name="fullname" placeholder="Nomor" value=""></select>
                    </div>
                </div>
                <br>
                <div class="row">
                  
                  <div class="col-md-3 offset-5">
                      <button class="btn btn-lg btn-info" type="submit">List Produk</button>
                  </div>
                  <div class="col-md-3 ">
                      <button class="btn btn-lg btn-info" type="submit">List Pembelian</button>
                  </div>
            </div>
        </div>
    </div>

    
@endsection