@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

<link rel="stylesheet" href="/css/table.css">
    <div class="container-fluid">
                <div class="container" style="padding:10px; margin:auto">
                        <div class="row ">
                            <div class="col-md-2 " style="float:left">
                                <img src="{{URL::to('/upload/'.$users->profile_image)}}" style="width:auto; height:150px; border-radius:50% margin-right:25px">
                            </div>
                            <div class="col-md-4">
                                <div class="text-left">
                                    <form class="form-group" action="{{route('gantipassword', $users->id)}}" method="GET" class="container clearfix " enctype="multipart/form-data">
                                            <h2 class="text-center" style="align-text:center">Profile
                                                    <button type="submit" class="btn btn-info btn-profile " name="password" value="update"><i class="fas fa-key"></i></button>
                                            </h2>
                                            <p ><i class="fas fa-user-circle"></i> {{$users->fullname}}</p>
                                            <p><i class="fas fa-home"></i> {{$users->address}} {{$users->city}}</p>
                                    </form>
                                </div>
                            </div>
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
                                                                    <td class="align-middle">Rp.{{number_format($order->total)}}</td>
                                                                    <td class="align-middle">{{$order->qty}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($totalhargadanquantity= $order->total * $order->qty), 0}}</td>
                                                                    <td class="align-middle">{{date('d F, Y', strtotime($order->order_date))}} at {{date('g:ia', strtotime($order->order_date))}} </td>
                                                                    <td class="align-middle">Sudah Membayar</td>
                                                                @endif
                                                                @if(Auth::user() && $order->status==1)
                                                                    <td class="align-middle">{{$order->product->product_name}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($order->total)}}</td>
                                                                    <td class="align-middle">{{$order->qty}}</td>
                                                                    <td class="align-middle">Rp.{{number_format($totalhargadanquantity= $order->total * $order->qty), 0}}</td>
                                                                    <td class="align-middle">{{date('d F, Y', strtotime($order->order_date))}} at {{date('g:ia', strtotime($order->order_date))}} </td>
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
                            
                    </div>
                    
                </div>
                
                <div class="col-md-8 offset-2" style="padding-bottom:30px">
                        <form action="{{route('editUser', $users->id)}}" method="post" class="container clearfix " enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                            <input type="file" name="img" >
                            </div>
                            <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{$users->email}}">
                            </div>
                            <div class="form-group">
                            <label>Nama:</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Nama" value="{{$users->fullname}}">
                            </div>
                            <div class="form-group">
                            <label>Alamat:</label>
                            <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{$users->address}}">
                            </div>
                            <div class="form-group">
                            <label>Kota:</label>
                            <input type="text" class="form-control" name="city" placeholder="Kota" value="{{$users->city}}">
                            </div>
                            <div class="form-group">
                            <label>Kode Pos:</label>
                            <input type="text" class="form-control" name="postal" placeholder="Kode Pos" value="{{$users->postal_code}}">
                            </div>
                            <div class="form-group " >
                            <button type="submit" class="btn btn-info btn-block " name="action" value="update">Ubah Profile</button>
                            </div>
                        </form>   
                </div>

      
    </div>

@endsection
