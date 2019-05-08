@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:80vh">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                @if(count($errors)>0)
                    <p class="alert alert-danger">{{$errors->first()}}</p>
                @endif
                @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title" style="margin-top:40px;text-align:center"><img src="upload/logo_bukanjak.png" class="img" style="width:350px"></h1>
                        <h4 class="card-title" style="margin-left:30px"><b>Admin Panel Login</b></h4><br><br>
                        <form action="{{route('store.admin')}}" method="post" class="container">
                            {{csrf_field()}}
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
                            <br>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <br>
                            <button type="submit" class="btn btn-block btn-info" style="margin-bottom:40px" name="action" value="create">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection