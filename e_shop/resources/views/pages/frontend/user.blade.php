@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

    <div class="container-fluid">
        <div class="panel">
                <div class="jumbotron" style="padding:0px; margin:auto">
                        <div class="row ">
                            <div class="col-md-2 " style="float:left">
                                <img src="{{URL::to('/upload/'.$users->profile_image)}} style="margin:auto; max-height:200px; max-width:80% "  class="rounded mx-auto d-block img-responsive img-fluid" class="img-circle" alt="..." >
                            </div>
                            <div class="col-md-4">
                                <h1>Welcome</h1>
                                <div class="text-left">
                                    <form class="form-group">
                                            <h3>{{$users->fullname}}</h3>
                                            <p>{{$users->address}}, {{$users->city}}</p>
                                            <p>{{$users->postal_code}}</p>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-2" style="">
                                <a style="margin-bottom:140px" href="#" class="btn btn-info" name="changebutton">Ganti Password</a>
                            </div>
                            <div class="col-md-4">
                                    <h3>Riwayat Pembelian</h3>
                                    <div class="text-left">
                                        <form class="form-group">
                                                <h3>{{$orders->order_date}}</h3>
                                                <p>{{$users->address}}, {{$users->city}}</p>
                                                <p>{{$users->postal_code}}</p>
                                        </form>
                                    </div>
                            </div>
                    </div>
                </div>
                <div class="panel-body">
                        <form action="{{route('editUser', $users->id)}}" method="post" class="container clearfix " enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                            <input type="file" name="img">
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
                            <button type="submit" class="btn btn-info btn-profile " name="action" value="update">Ubah Profile</button>
                            </div>
                        </form>   
                        </div>
                    </div>
                </div>
        </div>
    </div>
</nav>
</body>
</html>

@endsection
