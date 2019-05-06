@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form class="col-md-10">
                            <h2><span class="fas fa-box-open" aria-hidden="true"></span> Viewing Order</h2><br>
                            <h3>Customer</h3>
                            <div class="card" style="margin-bottom:20px">
                                <div class="card-body">
                                    <div class="row" style="margin-left:10px">
                                        <div class="col-md-10">
                                            <label>Name :</label>
                                            <label> {{$orders->fullname}}</label><br>
                                            <label>Address :</label>
                                            <label> {{$orders->address}}</label><br>
                                            <label>City :</label>
                                            <label> {{$orders->city}}</label><br>
                                            <label>Postal Code :</label>
                                            <label> {{$orders->postal_code}}</label>
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
                                                    <div class="col-md-10">
                                                        <label>Product :</label>
                                                        <label> {{$detail->product->product_name}}</label><br>
                                                        <label>Price :</label>
                                                        <label> {{number_format($detail->price,0)}}</label><br>
                                                        <label>Quantity :</label>
                                                        <label> {{$detail->qty}} pcs</label><br>
                                                    </div>
                                                </div><br>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <h4 class="float-right">Total Price: {{number_format($orders->total,0)}}</h4>
                                </div>
                            </div>
                            <h3>Payment Check</h3>
                            <div class="card" style="margin-bottom:20px">
                                <div class="card-body" style="margin-left:10px">
                                    @if($orders->payment_check == null)
                                        <h4>No payment</h4>
                                    @else
                                        <img class="img" style="width:100px" src="/upload/{{$orders->payment_check}}">
                                    @endif
                                    <form action="{{ route('payment.order') }}" method="POST">
                                        <a href="" class="btn btn-success float-right" style="margin-top:50px">Approved</a>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection