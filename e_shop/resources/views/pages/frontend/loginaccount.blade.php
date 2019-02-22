@extends('layouts.app')

@section('content')

@if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{$error}}</li>
        @endforeach
    </ul>
@endif
        <div class="container-fluid" style="padding:4%">
                <div class="row" >
                        <div class="col-md-6" >
                                <img class="rounded mx-auto d-block img-responsive img-fluid" style="height: auto; max-width: 100%;" width="500px" src="upload/Logo-edit.png">
                            </div>
                            <div class="col-md-6 login-form "  >
                                <div class="card card-login " style=" border: solid 5px #e0e0e0; background:#f2f2f2; height:400px">
                                    <div class="form-group ">
                                            <h2 class="card-title " class="text-center"><strong>Sign In</strong></h2>
                                            <form action="{{route('store.loginaccount')}}" method="post" class="container">
                                                {{csrf_field()}}
                                                @if (session('status'))
                                                    <div class="alert alert-success">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif
                                                @if (session('failed'))
                                                    <div class="alert alert-danger">
                                                        {{ session('failed') }}
                                                    </div>
                                                @endif
                                                @if(count($errors)>0)
                                                    <p class="alert alert-danger">Masukkan email dan password untuk masuk</p>
                                                @endif
                                                <div class="form-group">
                                                <h6>Email:</h6>
                                                <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}">
                                                </div>
                                                <div class="form-group">
                                                <h6>Password:</h6>
                                                <input type="password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                                <div>
                                                <button type="submit" class="btn btn-info btn-block" style="float: center" name="action" value="create"><i class="fas fa-sign-in-alt"> Login</i></button>
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