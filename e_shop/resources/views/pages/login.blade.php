@extends('layout.app')

@section('content')
    @if(count($errors)>0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="alert alert-danger">{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div class="form-group container">
        <h3>Login</h3>
        <form action="{{route('loginPage')}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="example@mail.com">
            <br/>
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <br/>
            <br/>
            <label>Gambar:</label>
            <input type="file" name="img">
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Login</button>
        </form>
    </div>
@endsection