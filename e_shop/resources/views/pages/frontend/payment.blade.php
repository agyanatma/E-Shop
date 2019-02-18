@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2 >Metode Pembayaran</h2><br>
            <div class="row">
                <div class="card col-sm-5" style="margin:5px">
                    <div class="card-body">
                        <img class="img" style="width:80px" src="/upload/mandiri.png">
                        <p>Bank Mandiri</p>
                        <p>Rekening Bank: <span class="text-danger"><b>770092231444000</b></span>
                            <br>Pemegang Rekening: <span class="text-danger"><b>Adam Maulidani</b></span>
                            <br>Situs resmi: <a href="http://www.bankmandiri.co.id/">www.bankmandiri.co.id</a>
                        </p>
                    </div>
                </div>
                <div class="card col-sm-5" style="margin:5px">
                    <div class="card-body">
                        <img class="img" style="width:80px" src="/upload/mandiri.png">
                        <p>Bank Mandiri</p>
                        <p>Rekening Bank: <span class="text-danger"><b>770092231444000</b></span>
                            <br>Pemegang Rekening: <span class="text-danger"><b>Adam Maulidani</b></span>
                            <br>Situs resmi: <a href="http://www.bankmandiri.co.id/">www.bankmandiri.co.id</a>
                        </p>
                    </div>
                </div>
            </div>
            <form style="margin-top:50px" action="" method="POST" enctype="multipart/form-data">
                <p>Upload Bukti Pembayaran:</p>
                <input type="file" name="image">
                <button type="submit" class="btn btn-success float-right" style="margin-top:50px">Upload</button>
            </form>
        </div>
    </div>
</div>

@endsection