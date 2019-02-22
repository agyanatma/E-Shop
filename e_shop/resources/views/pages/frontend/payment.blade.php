@extends('layouts.app')

@section('content')
<div class="container-fluid" style="padding: 4%; ">
        <div class="row" style="padding:3%">
               
                <div class="col-lg-10">
                        <h2 class="title-cart" ><strong>Payment Method</strong></h2>
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
                    <div class="row">
                        <div class=" col-md-6 col-lg-6 col-sm-12 col-12" >
                            <div class="card-body-payment card">
                                <div class="card-box-payment">
                                    <img class="img" style="width:80px" src="/upload/logo_bri.png">
                                    <p class="card-title-payment"><strong>Bank BRI</strong></p>
                                    <p>Bank Account: <span class="text-danger"><b>034 101 000 743 303</b></span>
                                        <br>Account Holder: <span class="text-danger"><b>Adam Maulidani</b></span>
                                        <br>Official Website: <a href="http://www.bri.co.id/">www.bri.co.id</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-lg-6 col-sm-12 col-12" >
                            <div class="card-body-payment card">
                                <div class="card-box-payment">
                                <img class="img" style="width:80px" src="/upload/logo_mandiri.png">
                                <p class="card-title-payment"><strong>Bank Mandiri</strong></p>
                                <p>Bank Account: <span class="text-danger"><b>7700 922 314 440</b></span>
                                    <br>Account Holder: <span class="text-danger"><b>Adam Maulidani</b></span>
                                    <br>Official Website: <a href="http://www.bankmandiri.co.id/">www.bankmandiri.co.id</a>
                                </p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-lg-6 col-sm-12 col-12" >
                                <div class="card-body-payment card">
                                    <div class="card-box-payment">
                                        <img class="img" style="width:80px" src="/upload/logo_bca.png">
                                        <p class="card-title-payment"><strong>Bank BCA</strong></p>
                                        <p>Bank Account: <span class="text-danger text-underline"><b>731 025 2527</b></span>
                                            <br>Account Holder: <span class="text-danger"><b>Adam Maulidani</b></span>
                                            <br>Official Website: <a href="http://www.bca.co.id/">www.bca.co.id</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6 col-lg-6 col-sm-12 col-12" >
                                <div class="card-body-payment card" >
                                    <div class="card-box-payment" >
                                        <img class="img card-image-payment" style="width:80px" src="/upload/logo_bni.png">
                                        <p class="card-title-payment"><strong>Bank BNI</strong></p>
                                        <p>Bank Account: <span class="text-danger"><b>023 827 2088</b></span>
                                            <br>Account Holder: <span class="text-danger"><b>Adam Maulidani</b></span>
                                            <br>Official Website: <a href="http://www.bni.co.id/">www.bni.co.id</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <form style="margin-top:20px" action="{{route('paymentcardpost', $orders->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <p>Upload Bukti Pembayaran:</p>
                       
                        <input type="file" name="payment" required>
                        
                        <button type="submit" class="btn btn-success float-right" value="update" style="margin-top:20px"><i class="fas fa-upload"> Upload</i></button>
                    </form>
                </div>
            </div>
</div>
@endsection