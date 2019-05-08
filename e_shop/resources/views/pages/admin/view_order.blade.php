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
                                    <h4 class="float-right">Total Price: {{number_format($orders->total,0)}}</h4><br><br>
                                    <label class="float-right">Status Pembayaran : <span>
                                    @if($orders->status == 2)
                                        Sudah Dibayar
                                    @elseif($orders->status == 1)
                                        Menunggu Konfirmasi
                                    @else
                                        Belum Dibayar
                                    @endif
                                    </span></label>
                                </div>
                            </div>
                            <h3>Payment Check</h3>
                            <div class="card" style="margin-bottom:20px">
                                <div class="card-body" style="margin-left:10px">
                                    <div class="row" style="height:100px">
                                        <div class="col-md-9">
                                            @if($orders->payment_check == null)
                                                <h4>No payment</h4>
                                            @else
                                                <img id="myImg" class="img" style="width:100%;max-width:100px" src="/upload/{{$orders->payment_check}}" alt="{{$orders->payment_check}}">

                                                <div id="myModal" class="modal">
                                                    <span class="close">&times;</span>
                                                    <img class="modal-content" id="img01">
                                                    <div id="caption"></div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('payment.order', $orders->id) }}" type="submit" class="btn btn-info float-right">Payment Approved</a>
                                        </div>
                                    </div>
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