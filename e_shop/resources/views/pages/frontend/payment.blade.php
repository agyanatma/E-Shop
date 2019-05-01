@extends('layouts.app')

@section('content')

<div class="container-fluid " style="padding:4%;">
  <h2 class="title-cart text-center" ><strong>Payment Method</strong></h2>
  <h4 class="text-center" style="line-height:50px;"> Make a payment an amount of <span class="text-danger"><strong>IDR {{number_format($orders->total,0)}}</strong></span> to one of the bank accounts below :</h4>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if ($errors->has('payment'))
          <div class="alert alert-danger">
              {{$errors->first('payment')}}
          </div>
    @endif
    
      {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="padding-top:2%;">
                          <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner">
                            <div class="carousel-item active ">
                              <img class="rounded mx-auto d-block img-fluid slider-payment"  src="/upload/BANKBRI.png" alt="First slide">
                            </div>
                            <div class="carousel-item ">
                              <img class="rounded mx-auto d-block img-fluid slider-payment"   src="/upload/BANKBCA.png" alt="Second slide">
                            </div> 
                            <div class="carousel-item ">
                              <img class=" rounded mx-auto d-block img-fluid slider-payment"  src="/upload/BANKMANDIRI.png" alt="Third slide">
                            </div>
                            <div class="carousel-item ">
                              <img class="rounded mx-auto d-block img-fluid slider-payment" src="/upload/BANKBNI.png" alt="Fourth slide">
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon " ></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" ></span>
                            <span class="sr-only">Next</span>
                          </a>
                      </div> --}}
      <div class="row text-center" >
        <div class=" col-md-3 col-lg-3 col-sm-12 col-12" >
            <div class="card-body-payment card">
                <div class="card-box-payment">
                    <img class="img img-fluid card-image-payment" style="height:50px;" src="/upload/logo_bri.png">
                    <h5 class="card-title-payment"><strong>Bank BRI</strong></h5>
                    <h5><span class="text-danger"><b>034 101 000 743 303</b></span><h5>
                    <h5>Official Website<a href="http://www.bri.co.id/"> www.bri.co.id</a></h5>
                    <h5 class="text-center">a.h Adam Maulidani</h5>
                </div>
            </div>
        </div>
        <div class=" col-md-3 col-lg-3 col-sm-12 col-12" >
            <div class="card-body-payment card">
                <div class="card-box-payment">
                    <img class="img img-fluid card-image-payment" style="height:50px;" src="/upload/logo_mandiri.png">
                    <h5 class="card-title-payment"><strong>Bank Mandiri</strong></h5>
                    <h5><span class="text-danger"><b>7700 922 314 440</b></span><h5>
                    <h5>Official Website<a href="http://www.bankmandiri.co.id/"> www.bankmandiri.co.id</a></h5>
                    <h5 class="text-center">a.h Adam Maulidani</h5>
                </div>
            </div>
        </div>
        <div class=" col-md-3 col-lg-3 col-sm-12 col-12" >
                <div class="card-body-payment card">
                    <div class="card-box-payment">
                        <img class="img img-fluid card-image-payment" style="height:50px;" src="/upload/logo_bca.png">
                        <h5 class="card-title-payment"><strong>Bank BCA</strong></h5>
                        <h5><span class="text-danger"><b>731 025 2527</b></span><h5>
                        <h5>Official Website<a href="http://www.bca.co.id/"> www.bca.co.id</a></h5>
                        <h5 class="text-center">a.h Adam Maulidani</h5>
                    </div>
                </div>
        </div>
        <div class=" col-md-3 col-lg-3 col-sm-12 col-12" >
                <div class="card-body-payment card" >
                    <div class="card-box-payment">
                        <img class="img img-fluid card-image-payment" style="height:50px;" src="/upload/logo_bni.png">
                        <h5 class="card-title-payment"><strong>Bank BNI</strong></h5>
                        <h5><span class="text-danger"><b>023 827 2088</b></span><h5>
                        <h5>Official Website<a href="http://www.bni.co.id/"> www.bni.co.id</a></h5>
                        <h5 class="text-center">a.h Adam Maulidani</h5>
                    </div>
                </div>
        </div>
      </div>
      <div class="card-payment-notes-body" >
          <div class="card-payment-notes">
              <h4 class="text-left" id="notes-title" style="border-bottom: solid 3px #e0e0e0;"><strong>*Notes</strong></h4>
              <h5 class="text-justify font-wight-light mx-3" id="description-notes">1. You can make payments through other banks and may incur additional fees according to the policies of each bank.</h5>
              <h5 class="text-justify font-wight-light mx-3" id="description-notes">2. If you use m-banking, e-banking or non-cash ATMs, add the number orders according to each bank.</h5>
          <h5 class="text-justify font-wight-light mx-3" id="description-notes">3. Upload proof of payment in png, jpg, and jpeg formats.</h5>
          </div>
      </div>
      <div style="margin-top:30px">
        <form style="clearfix" action="{{route('paymentcardpost', $orders->id)}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h5 class="text-left" id="notes-title" ><strong>Upload File:</strong></h5>
            <div class="row align-items-center mx-auto">
              <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <input type="file" name="payment" required>
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12 col-12">
                <button type="submit" class="btn btn-success "  value="update" style="float:right"><i class="fas fa-upload"> Upload</i></button>
              </div>
            </div>
        </form>
      </div>      
</div>
@endsection