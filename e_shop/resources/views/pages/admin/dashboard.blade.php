@extends('layout.admin')

@section('content')
        <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <!-- Website Overview -->
                    <div class="card border-0">
                    <div class="card bg-light text-dark border-0">
                        <div class="card-body" style="padding:5px; border:none">
                            <h2 class="align-middle" style="margin-left:10px"><span class="fas fa-cog"> </span> Dashboard
                                <span class="float-right" style="margin-right:10px">
                                    <span class="align-middle" style="font-size:large; margin-right:10px">
                                        <span class="fas fa-circle align-middle" style="font-size:small; margin-right:10px; color:rgb(36, 255, 25)"> </span>Active User
                                    </span>
                                       
                                </span></h2>
                        </div>
                    </div>
                      <div class="card-deck" style="margin-top:20px">
                        <div class="col-md-4" style="padding:0px">
                            <div class="card bg-danger border-0">
                                <a href="/admin/product" style="color:inherit; text-decoration:inherit">
                                    <div class="card-body text-white">
                                        <h2><span class="fas fa-box-open" aria-hidden="true"></span> {{$product}}</h2>
                                        <h3>Products</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding:0px">
                            <div class="card bg-success border-0">
                                <a href="/admin/category" style="color:inherit; text-decoration:inherit">
                                    <div class="card-body text-white">
                                        <h2><span class="fas fa-clipboard-list" aria-hidden="true"></span> {{$category}}</h2>
                                        <h3>Categories</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding:0px">
                            <div class="card bg-primary border-0">
                                <a href="/admin/order" style="color:inherit; text-decoration:inherit">
                                    <div class="card-body text-white">
                                        <h2><span class="fas fa-dolly-flatbed" aria-hidden="true"></span> {{$order}}</h2>
                                        <h3>Orders</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                      </div>
                      </div>
                    </div>
                    <div class="col-md-12" style="margin-top:20px">
                        <div class="card border-0">
                            <div class="card-header bg-light" style="border:none; padding:5px">
                                <h2 class="align-middle" style="margin-left:10px"><span class="fas fa-users"> </span> Latest Users
                                <span>
                                    <p class="float-right" style="font-size:large; margin-right:10px; margin-top:10px">Total Users: {{$profile}}</p>    
                                </span></h2>
                            </div>
                            <div class="card-body" style="
                            margin:-20px; 
                            overflow-y: auto;
                            -ms-overflow-style: -ms-autohiding-scrollbar;">
                                <table class="table table-hover table-bordered" style="height:100%">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Postal Code</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($item) > 0)
                                            @foreach ($item as $items)
                                            <tr>
                                                <td class="align-middle">{{$items->email}}</td>
                                                @if($items->admin==1)
                                                    <td class="align-middle">{{$items->fullname}} <span class="fas fa-crown"></span></td>
                                                @else
                                                    <td class="align-middle">{{$items->fullname}}</td>
                                                @endif
                                                <td class="align-middle">{{$items->address}}</td>
                                                <td class="align-middle">{{$items->city}}</td>
                                                <td class="align-middle">{{$items->postal_code}}</td>
                                                <td class="align-middle" style="width:150px">
                                                    <a href="{{ route('admin', $items->id) }}" class="btn btn-sm btn-warning" name="admin">Admin</a>
                                                    <span>
                                                        <a href="{{ route('adminDelete', $items->id) }}" class="btn btn-sm btn-danger" name="delete">Delete</a>
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <h3>No User Found</h3>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
              </div>

    
@endsection