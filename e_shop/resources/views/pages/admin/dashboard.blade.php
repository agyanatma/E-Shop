@extends('layouts.admin')

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-deck" style="margin:40px 30px 0px 0px">
                        <div class="col-md-4">
                            <div class="card" style="height:350px; width:100%">
                                <div class="card-body text-white" style="background-color: #019da5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1><i class="fas fa-box-open" aria-hidden="true"></i> {{$product}}</h1>
                                            <h4> Products</h4>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:20px">
                                        <p>Latest Items</p>
                                            <ul class="list-group">
                                                @foreach($_product as $p)
                                                    <li class="list-group-item" style="color:black">{{str_limit($p->product_name,30)}} ({{$p->created_at->diffforHumans()}})</li>
                                                @endforeach
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0" style="height:350px; width:100%">
                                <div class="card-body text-white" style="background-color: #019da5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1><i class="fas fa-clipboard-list" aria-hidden="true"></i> {{$category}}</h1>
                                            <h4>Categories</h4>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 20px">
                                        <p>Latest Items</p>
                                            <ul class="list-group">
                                                @foreach($_category as $c)
                                                    <li class="list-group-item" style="color:black">{{$c->category_name}} ({{$p->created_at->diffforHumans()}})</li>
                                                @endforeach
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0" style="height:350px; width:100%">
                                <div class="card-body text-white" style="background-color: #019da5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1><i class="fas fa-users" aria-hidden="true"></i> {{$user}}</h1>
                                            <h4>Users</h4>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 20px">
                                        <p>Latest Items</p>
                                            <ul class="list-group">
                                                @foreach($_user as $o)
                                                    <li class="list-group-item" style="color:black">{{str_limit($o->email,35)}} ({{$o->created_at->diffforHumans()}})</li>
                                                @endforeach
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card border-0" style="margin:40px 30px 0px 30px">
                        <div class="card-body">
                        <h1><i class="fas fa-dolly-flatbed" aria-hidden="true"></i> Orders</h1>
                        <h4>Total Items : {{$order}}</h4><br>
                            <div class="table-responsive" style="margin-top:20px; margin-bottom: 50px; position: relative; height: 500px; overflow: auto; display:block">
                                <table class="table table-bordered table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th style="width:110px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ord as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->fullname}}</td>
                                            <td>Rp {{number_format($item->total,0)}}</td>
                                            <td>
                                                @if($item->status==1)
                                                Menunggu Konfirmasi
                                                @elseif($item->status==2)
                                                Sudah Dibayar
                                                @else
                                                Belum Dibayar
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==1)
                                                <a href="{{ route('show.order', $item->id) }}" type="submit" class="btn btn-sm btn-warning align-middle text-white" style="width:110px">Payment</a>
                                                @elseif($item->status==2)
                                                <a href="{{ route('show.order', $item->id) }}" type="submit" class="btn btn-sm btn-success align-middle text-white" style="width:110px">Payment</a>
                                                @else
                                                <a href="{{ route('show.order', $item->id) }}" type="submit" class="btn btn-sm btn-danger align-middle text-white" style="width:110px">Payment</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection