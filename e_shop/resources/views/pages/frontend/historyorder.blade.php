@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')
<div class="container-fluid" style="padding-left:4%;padding-right:4%;padding-top:2%;">
    
        <h2 class="title-cart text-center" ><strong>History Order</strong></h2>
        <div class="card-total-cart text-center clearfix pb-4" >
                <strong class="totalqty ">Total Order</strong>
                <strong class="totalqty " >({{$totalordermasuk}})</strong>
        </div>
        <div class="" >
        <div class="table-wrapper-scroll-y " >
            <table id="dtVerticalScrollExample " class="table table-striped table-bordered scrollingTable mx-auto"  >
                <thead>
                    <tr>
                        <th class="th-lg text-center">Order Date</th>
                        <th class="th-lg text-center">Fullname</th>
                        <th class="th-lg text-center">Total Price</th>
                        <th class="th-lg text-center">Status</th>
                        <th class="th-lg text-center">Detail</th>
                    </tr>
                </thead>
            <tbody>
                    @if(count($orders) > 0)
                        @foreach ($orders as $order)
                        <tr>
                                <td class="align-middle text-center">{{date('d F, Y', strtotime($order->order_date))}} </td>
                                <td class="align-middle text-center">{{$order->fullname}}</td>
                                <td class="align-middle text-center">Rp.{{number_format($order->total,0)}}</td>
                                @if(Auth::user() && $order->status==2)
                                <td class="align-middle text-center">Already Paid</td>
                                @endif
                                @if(Auth::user() && $order->status==1)
                                <td class="align-middle text-center">Waiting For Confirmation</td>
                                @endif
                                @if(Auth::user() && $order->status==0)
                                <td class="align-middle text-center">Not Yet Paid</td>
                                @endif
                                <td class="align-middle text-center historyorder"><a href="{{route('detailorder', $order->id)}}" class="btn btn-info"><i class="fas fa-info-circle"></i> Detail Order</a></td>
                        </tr>
                        @endforeach
                    @else
                        <h3>No posts found!</h3>
                    @endif
            </tbody>
        </table>           
        </div>
    </div>
    <div class="pagination fixed" style="margin:2%" >
        {{$orders->links()}}
    </div>

</div>
@endsection