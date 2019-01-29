@extends('layout.admin')

@section('content')

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <!-- Website Overview -->
                    <div class="card border-0">
                    <div class="card bg-light text-dark border-0">
                        <div class="card-body" style="padding:5px; border:none">
                            <h2 class="align-middle" style="margin-left:10px"><span class="fas fa-cog"> </span> Dashboard
                                <span class="float-right" style="margin-right:10px">
                                    <span class="align-middle" style="font-size:large; margin-right:10px">
                                        <span class="fas fa-circle align-middle" style="font-size:small; margin-right:10px; color:rgb(36, 255, 25)"> </span>Active User
                                    </span>
                                    <img src="/upload/{{$users->profile_image}}" class="rounded-circle object-fit-cover" width="40" height="40">
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
                      <!-- Latest Users -->

                    <!--<div class="col-md-3">
                        <div class="card-deck" style="margin-top:20px">
                            <div class="card bg-warning">
                                <div class="card-body text-center">
                                    <img src="/upload/hinahina.jpg" class="rounded-circle object-fit-cover" style="margin:20px 10px 50px" width="100" height="100">
                                    <h4>Welcome Home,</h4>
                                    <h3>User admin</h3>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <div class="col-md-12" style="margin-top:20px">
                        <div class="card border-0">
                            <div class="card-header bg-light" style="border:none; padding:5px">
                                <h2 class="align-middle" style="margin-left:10px"><span class="fas fa-users"> </span> Latest Users</h2>
                                <!--<h2 class="align-middle"><span class="align-middle">
                                    <img src="/upload/{{$users->profile_image}}" class="rounded-circle object-fit-cover" width="40" height="40">
                                </span>Hello, {{$users->fullname}}</h2>-->
                            </div>
                            <div class="card-body" style="margin:-20px">
                                <table class="table table-hover table-bordered" style="height:100%">
                                    <thead>
                                        <tr>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Postal Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($item) > 0)
                                            @foreach ($item as $items)
                                            <tr>
                                                <td>{{$items->email}}</td>
                                                <td>{{$items->fullname}}</td>
                                                <td>{{$items->address}}</td>
                                                <td>{{$items->city}}</td>
                                                <td>{{$items->postal_code}}</td>
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