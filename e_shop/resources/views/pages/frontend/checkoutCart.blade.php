@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
        <h1> Checkout</h1>
        <h4 class="text-center"> Your Total : ${{$total}}</h4>
        <form action="{{ route('checkoutCart')}}" method="POST" id="checkout-form" class="clearfix">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="card-name">Card Holder Name</label>
                    <input type="text" id="card-name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="card-number ">Credit Card Number</label>
                    <input type="text" id="card-number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="card-expiry-month">Expiration Month</label>
                    <input type="text" id="card-expiry-month" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="card-expiry-year">Expiration Year</label>
                    <input type="text" id="card-expiry-year" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="card-cvc">CVC</label>
                    <input type="text" id="card-cvc" class="form-control" required>
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-success" style="float:right">Buy Now</button>
        </form>
        </div>
</div>
</div>
@endsection