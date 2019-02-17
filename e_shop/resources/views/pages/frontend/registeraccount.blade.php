
@extends('layouts.app')

@section('content')


    <div class="container-fluid" style="padding:4%">
        <div class="row" >
            <div class="col-md-6" >
                    <img class="rounded mx-auto d-block img-responsive img-fluid" style="height: auto; max-width: 100%;" width="500px" src="upload/Settings.png">
            </div>
            <div class="col-md-6 register-form"style="margin-top: 15px" >
                <div class="card card-register " style="padding:10px; border: solid 5px #e0e0e0; background:#f2f2f2; " >
                    <div class="form-group " >
                    <h2 class="card-title"><strong>Sign Up</strong></h2>
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
                        <h6>Email:</h6>
                        <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}" required>
                        @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{$errors->first('email')}}
                         </div>
                        @endif
                        </div>
                        <div class="form-group">
                        <h6>Password:</h6>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            {{$errors->first('password')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <h6>Nama:</h6>
                        <input type="text" class="form-control" name="fullname" placeholder="Nama" value="{{old('fullname')}}" required>
                        @if ($errors->has('fullname'))
                        <div class="alert alert-danger">
                            {{$errors->first('fullname')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <h6>Alamat:</h6>
                        <input type="text" class="form-control" name="address" placeholder="Alamat" value="{{old('address')}}" required>
                        @if ($errors->has('address'))
                        <div class="alert alert-danger">
                            {{$errors->first('address')}}
                        </div>               
                        @endif
                        </div class="form-group">
                        <div>
                        <h6>Kota:</h6>
                        <input type="text" class="form-control" name="city" placeholder="Kota" value="{{old('city')}}" required>
                        @if ($errors->has('city'))
                        <div class="alert alert-danger">
                            {{$errors->first('city')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <h6>Kode Pos:</h6>
                        <input type="text" class="form-control" name="postal" placeholder="Kode Pos" value="{{old('postal')}}" required>
                        @if ($errors->has('postal'))
                        <div class="alert alert-danger">
                            {{$errors->first('postal')}}
                        </div>               
                        @endif
                        </div>
                        <div class="form-group">
                        <h6>Profile Picture:</h6><br/>
                        <input type="file" name="img">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-info btn-block" style="float: right" name="action" value="create"><i class="fas fa-sign-out-alt"> Sign Up</i></button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
    </div>
                    
  </div>

@endsection