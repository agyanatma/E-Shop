@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col">
                <form class="form-inline">
                    <div class="col-lg-6" style="float:left">
                        <h1><span class="fas fa-dolly-flatbed" aria-hidden="true"></span>  Order</h1><br>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('newOrder')}}" type="submit" class="btn btn-primary" style="float:right">Add Order</a>
                    </div>
                </form>
            </div>
            <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @if(count($orders) > 0)
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="align-middle">{{$order->buyer->fullname}}</td>
                                            <td class="align-middle">{{$order->product->product_name}}</td>
                                            <td class="align-middle">Rp {{number_format($order->product->product_price, 0)}}</td>
                                            <td class="align-middle">{{number_format($order->qty, 0)}} pcs</td>
                                            <td class="align-middle">Rp {{number_format($order->total, 0)}}</td>
                                            <td class="align-middle">{{$order->order_date}}</td>
                                            @if($order->status==1)
                                                <td class="align-middle">Sudah Dibayar</td>
                                            @else
                                                <td class="align-middle">Belum Dibayar</td>
                                            @endif 
                                            <td class="align-middle" style="width:50px">
                                                <span class="float-right">
                                                    <a href="{{ route('deleteOrder', $order->id) }}" class="btn btn-danger" name="delete">Delete</a>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <h3>No posts found!</h3>
                                    @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
@endsection