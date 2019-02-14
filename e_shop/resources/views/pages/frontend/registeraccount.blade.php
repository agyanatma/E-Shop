
@extends('layouts.app')

@section('content')


    <div class="container-fluid">
        <div class="row" style="padding:20px 0 40px 0;">
            <div class="col-md-6" >
                    <img class="rounded mx-auto d-block img-responsive img-fluid" style="height: auto; max-width: 100%;" width="500px" src="upload/Settings.png">
            </div>
            <div class="col-md-6 register-form"style="margin-top: 15px">
                <div class="card card-register " style="padding:10px" >
                    <div class="form-group " >
                    <h3 class="card-title">Sign Up</h3>
                    @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    <form  action="{{route('store.registeraccount')}}" method="post" class="container" enctype="multipart/form-data" required>
                        {{csrf_field()}}
                        <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}" required>
                        @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{$errors->first('email')}}
                         </div>
                        @endif
                        </div>
                        <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            {{$errors->first('password')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" name="fullname" placeholder="Nama" value="{{old('fullname')}}" required>
                        @if ($errors->has('fullname'))
                        <div class="alert alert-danger">
                            {{$errors->first('fullname')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <label>Alamat:</label>
                        <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{old('address')}}" required>
                        @if ($errors->has('address'))
                        <div class="alert alert-danger">
                            {{$errors->first('address')}}
                        </div>               
                        @endif
                        </div class="form-group">
                        <div>
                        <label>Kota:</label>
                        <input type="text" class="form-control" name="city" placeholder="Kota" value="{{old('city')}}" required>
                        @if ($errors->has('city'))
                        <div class="alert alert-danger">
                            {{$errors->first('city')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <label>Kode Pos:</label>
                        <input type="text" class="form-control" name="postal" placeholder="Kode Pos" value="{{old('postal')}}" required>
                        @if ($errors->has('postal'))
                        <div class="alert alert-danger">
                            {{$errors->first('postal')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <label>Profile Picture:</label><br/>
                        <input type="file" name="img">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block" style="float: right" name="action" value="create">Sign Up</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
    </div>
                    
  </div>

@endsection