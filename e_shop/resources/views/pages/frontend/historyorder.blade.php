@extends('layouts.app')

@section('content')
<div class="col-md-6">
    <h3 class="text-center"> History Order</h3>
        <div class="table-wrapper-scroll-y">
                <table id="dtVerticalScrollExample" class="table table-striped table-bordered scrollingTable "  >
                    
                        <thead>
                        <tr>
                            <th class="th-sm text-center">Product</th>
                            <th class="th-sm text-center">Price</th>
                            <th class="th-sm text-center">Quantity</th>
                            <th class="th-sm text-center">Total Price</th>
                            <th class="th-sm text-center">Order Date</th>
                            <th class="th-sm text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if(count($orders) > 0)
                                @foreach ($orders as $order)
                                <tr>
                                    @if(Auth::user() && $order->status==2)
                                        <td class="align-middle">{{$order->product->product_name}}</td>
                                        <td class="align-middle">Rp.{{number_format($order->price), 0}}</td>
                                        <td class="align-middle">{{$order->qty}}</td>
                                        <td class="align-middle">Rp.{{number_format($order->total), 0}}</td>
                                        <td class="align-middle">{{date('d F, Y', strtotime($order->order_date))}} at {{date('g:ia', strtotime($order->updated_at))}} </td>
                                        <td class="align-middle">Sudah Membayar</td>
                                    @endif
                                    @if(Auth::user() && $order->status==1)
                                        <td class="align-middle">{{$order->product->product_name}}</td>
                                        <td class="align-middle">Rp.{{number_format($order->price), 0}}</td>
                                        <td class="align-middle">{{$order->qty}}</td>
                                        <td class="align-middle">Rp.{{number_format($order->total), 0}}</td>
                                        <td class="align-middle">{{date('d F, Y', strtotime($order->order_date))}} at {{date('g:ia', strtotime($order->updated_at))}} </td>
                                        <td class="align-middle">Menunggu Konfirmasi</td>
                                    @endif
                                </tr>
                                @endforeach
                            @else
                                <h3>No posts found!</h3>
                            @endif
                    </tbody>
                </table>
                
            </div>
            
</div>
@endsection