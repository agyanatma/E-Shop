
@extends('layouts.app')

@section('content')

    @if(count($errors)>0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6" style="padding:20px; margin:center;">
                <div class="card" style="padding:20px;">
                  <img src="" alt="...">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card " style="padding:10px">
                    <div class="form-group ">
                    <h3 class="text-center">Sign Up</h3>
                    <form action="{{route('store.registeraccount')}}" method="post" class="container" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="example@mail.com">
                        <br/>
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <br/>
                        <label>Nama:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Nama">
                        <br/>
                        <label>Alamat:</label>
                        <input type="text" class="form-control" name="address" placeholder="Alamat">
                        <br/>
                        <label>Kota:</label>
                        <input type="text" class="form-control" name="city" placeholder="Kota">
                        <br/>
                        <label>Kode Pos:</label>
                        <input type="text" class="form-control" name="postal" placeholder="Kode Pos">
                        <br/>
                        <label>Profile Picture:</label><br/>
                        <input type="file" name="img">
                        <br/>
                        <br/>
                        <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Sign Up</button>
                        
                    </form>
                    </div>
                </div>
            </div>
    </div>
                    
  </div>

@endsection