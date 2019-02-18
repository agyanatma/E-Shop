@extends('layouts.admin')

@section('content')
    <div class="form-group container">
        <form class="col-md-10">
            <h2><span class="fas fa-box-open" aria-hidden="true"></span> Viewing Order</h2><br>
            <h3>Customer</h3>
            <div class="card" style="margin-bottom:20px">
                <div class="card-body">
                    <div class="row" style="margin-left:10px">
                        <div class="col-sm-2">
                            <label>Name :</label><br>
                            <label>Address :</label><br>
                            <label>City :</label><br>
                            <label>Postal Code :</label><br>
                        </div>
                        <div class="col-sm-6">
                            <label>{{$orders->fullname}}</label><br>
                            <label>{{$orders->address}}</label><br>
                            <label>{{$orders->city}}</label><br>
                            <label>{{$orders->postal_code}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <h3>Orders</h3>
            <div class="card" style="margin-bottom:20px">
                <div class="card-body">
                    <ul>
                        @foreach($details as $detail)
                            <li>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Product :</label><br>
                                        <label>Price :</label><br>
                                        <label>Quantity :</label><br>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>{{$detail->product->product_name}}</label><br>
                                        <label>{{$detail->price}}</label><br>
                                        <label>{{$detail->qty}}</label><br>
                                    </div>
                                </div><br>
                            </li>
                        @endforeach
                    </ul>
                    <h4 class="float-right">Total Price: {{$orders->total}}</h4>
                </div>
            </div>
            <h3>Payment Check</h3>
            <div class="card" style="margin-bottom:20px">
                <div class="card-body" style="margin-left:10px">
                    @if($orders->payment_check == null)
                        <h4>No payment</h4>
                    @endif
                    <a href="{{}}" class="btn btn-success float-right" style="margin-top:50px">Approved</a>
                </div>
            </div>
            
        </form>
    </div>
    
@endsection