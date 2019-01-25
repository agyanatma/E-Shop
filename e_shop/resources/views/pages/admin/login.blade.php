@extends('layout.login')

@section('content')
    <div class="container">
        @if(count($errors)>0)
            <p class="alert alert-danger">Masukkan email dan password untuk masuk</p>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif
        <div class="row justify-content-center align-items-center" style="height:80vh">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <h1 style="margin-bottom: 30px; font-size:70px; text-align:center">{{ config('app.name', 'E-Shop') }}</h1>
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">Login</h1><br>
                        <form action="{{route('store.admin')}}" method="post" class="container">
                            {{csrf_field()}}
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}">
                            <br/>
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <br/>
                            <br/>
                            <button type="submit" class="btn btn-block btn-primary" style="float: right" name="action" value="create">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection