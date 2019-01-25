
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
        <h1 class="text-center col-md-2 offset-5" style="margin-top: 15px">{{ config('app.name', 'E-Shop') }}</h1>
        <div class="row">
            <div class="col-md-6" >
                    <img class="rounded mx-auto d-block img-responsive img-fluid" style="height: auto; max-width: 100%;" width="500px" src="upload/Logo-edit.png">
            </div>
            <div class="col-md-6 register-form"style="margin-top: 15px">
                <div class="card card-register " style="padding:10px" >
                    <div class="form-group " >
                    <h3 class="card-title">Sign Up</h3>
                    <form  action="{{route('store.registeraccount')}}" method="post" class="container" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="example@mail.com">
                        </div>
                        <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Nama">
                        </div>
                        <div class="form-group">
                        <label>Alamat:</label>
                        <input type="text" class="form-control" name="address" placeholder="Alamat">
                        </div class="form-group">
                        <div>
                        <label>Kota:</label>
                        <input type="text" class="form-control" name="city" placeholder="Kota">
                        </div>
                        <div class="form-group">
                        <label>Kode Pos:</label>
                        <input type="text" class="form-control" name="postal" placeholder="Kode Pos">
                        </div>
                        <div class="form-group">
                        <label>Profile Picture:</label><br/>
                        <input type="file" name="img">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" style="float: right" name="action" value="create">Sign Up</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
    </div>
                    
  </div>

@endsection