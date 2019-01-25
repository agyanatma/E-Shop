@extends('layouts.app')

@section('content')

   
        @if(count($errors)>0)
            <p class="alert alert-danger">Masukkan email dan password untuk masuk</p>
        @endif
   
        <div class="container-fluid">
            <h1 class="text-center col-md-2 offset-5" style="margin-top: 15px">{{ config('app.name', 'E-Shop') }}</h1>
                <div class="row">
                        <div class="col-md-6" >
                                <img class="rounded mx-auto d-block img-responsive img-fluid" style="height: auto; max-width: 100%;" width="500px" src="upload/Logo-edit.png">
                            </div>
                            <div class="col-md-6 login-form "  style="margin-top: 15px">
                                <div class="card card-login" >
                                    <div class="form-group ">
                                            <h3 class="card-title" class="text-center">Sign In</h3>
                                            <form action="{{route('store.loginaccount')}}" method="post" class="container">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                <label>Email:</label>
                                                <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}">
                                                </div>
                                                <div class="form-group">
                                                <label>Password:</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                                <div >
                                                <button type="submit" class="btn btn-info btn-block" style="float: center" name="action" value="create">Login</button>
                                                </div>
                                            </form>
                                    </div>
                                        
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
                                    
@endsection