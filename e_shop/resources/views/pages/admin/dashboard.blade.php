@extends('layouts.admin')

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-deck" style="margin:40px 30px 0px 0px">
                        <div class="col-md-4">
                            <div class="card border-0" style="height:350px; width:100%">
                                <div class="card-body text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1><i class="fas fa-box-open" aria-hidden="true"></i> {{$product}}</h1>
                                            <h4> Products</h4>
                                        </div>
                                        <div class="col-sm-12" style="margin-top:20px">
                                        <p>Latest Items</p>
                                            <ul class="list-group">
                                                @foreach($_product as $p)
                                                    <li class="list-group-item">{{str_limit($p->product_name,30)}} ({{$p->created_at->diffforHumans()}})</li>
                                                @endforeach
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0" style="height:350px; width:100%">
                                <div class="card-body text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1><i class="fas fa-clipboard-list" aria-hidden="true"></i> {{$category}}</h1>
                                            <h4>Categories</h4>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 20px">
                                        <p>Latest Items</p>
                                            <ul class="list-group">
                                                @foreach($_category as $c)
                                                    <li class="list-group-item">{{$c->category_name}} ({{$p->created_at->diffforHumans()}})</li>
                                                @endforeach
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0" style="height:350px; width:100%">
                                <div class="card-body text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1><i class="fas fa-users" aria-hidden="true"></i> {{$user}}</h1>
                                            <h4>Users</h4>
                                        </div>
                                        <div class="col-sm-12" style="margin-top: 20px">
                                        <p>Latest Items</p>
                                            <ul class="list-group">
                                                @foreach($_user as $o)
                                                    <li class="list-group-item">{{str_limit($o->email,35)}} ({{$o->created_at->diffforHumans()}})</li>
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
                        <div class="card-header bg-white" style="border:none; padding:5px">

                        </div>
                        <div class="card-body bg-white">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection