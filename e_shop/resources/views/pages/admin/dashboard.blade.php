@extends('layout.admin')

@section('content')
        <div class="container">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="row">
                  <div class="col-md-12">
                    <div class="card border-0">
                    <div class="card bg-light text-dark border-0">
                        <div class="card-body" style="padding:5px; border:none">
                            <h2 class="align-middle" style="margin-left:10px"><span class="fas fa-cog"> </span> Dashboard
                                <span class="float-right" style="margin-right:10px">
                                    <span class="align-middle" style="font-size:large; margin-right:10px">
                                        <span class="fas fa-circle align-middle" style="font-size:small; margin-right:10px; color:rgb(36, 255, 25)"> </span>Active User
                                    </span>
                                        <a href="{{route ('user', $users->id)}}"><img src="{{$users->profile_image}}" class="rounded-circle object-fit-cover" width="40" height="40"></a>
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
                                <h2 class="align-middle" style="margin-left:10px"><i class="fas fa-users"></i> Users</h2>
                            </div>
                            <div class="card-body bg-light">
                                <table id="datauser" class="table table-bordered">
                                    <thead style="background: white">
                                        <tr>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Postal Code</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@push('scripts')
<script>
    $(function(){
        $('#datauser').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{!! route('table.user') !!}',
            columns: [
                {data: 'email', name: 'email', class: 'align-middle'},
                {data: 'fullname', name: 'fullname', class: 'align-middle'},
                {data: 'address', name: 'address', class: 'align-middle'},
                {data: 'city', name: 'city', class: 'align-middle'},
                {data: 'postal_code', name: 'postal_code', width:'90', class: 'align-middle'},
                {data: 'role', name: 'role', width:'30', class: 'align-middle', searchable: false},
                {data: 'action', name: 'action', searchable: false, orderable: false, width:91}
            ]
        });
    });
</script>
@endpush