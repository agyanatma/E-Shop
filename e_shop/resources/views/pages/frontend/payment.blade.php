@extends('layouts.app')

@section('content')
<div class="container" style="padding: 4%; ">
<div class="row">
        <div class="col-md-12">
        <h2 class="title-cart text-center" ><strong>Payment</strong></h2>
        <h4 class="text-center"> Your Total : ${{$total}}</h4>
        <form action="{{ route('bayar') }}" method="POST" id="checkout-form" class="clearfix">
            {{csrf_field()}}
                
                <div class="form-group">
                    <label for="card-number ">No Rekening</label>
                    <input type="text" id="card-number" class="form-control" required>
                </div>
                
                <div class="form-group " style="padding-top:20px">
                    <label for="card-number ">Bukti Pembayaran</label>
                        <input type="file"  name="img" >
                </div>
                <button type="submit" class="btn btn-success" style="float:right">Payment Now</button>
        </form>
        </div>
</div>
</div>
@endsection