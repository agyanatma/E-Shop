@extends('layout.user')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-lg-6">
            <form class="form-inline">
                <img style="margin:20px" width="200px" src="{{$users->profile_image}}">
                <form class="form-group">
                    <h2>{{$users->fullname}}</h2><br>
                    <p>{{$users->address}}, {{$users->city}}</p><br>
                    <p>{{$users->postal_code}}</p><br>
                </form>
            </form>
        </div>
        <form action="{{route('editProfile', $users->id)}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="file" name="img"><br><br><br>
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{$users->email}}">
            <br/>
            <label>Nama:</label>
            <input type="text" class="form-control" name="fullname" placeholder="Nama" value="{{$users->fullname}}">
            <br/>
            <label>Alamat:</label>
            <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{$users->address}}">
            <br/>
            <label>Kota:</label>
            <input type="text" class="form-control" name="city" placeholder="Kota" value="{{$users->city}}">
            <br/>
            <label>Kode Pos:</label>
            <input type="text" class="form-control" name="postal" placeholder="Kode Pos" value="{{$users->postal_code}}">
            <br/>
            
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="update">Ubah Profile</button>
        </form>

    </div>
@endsection