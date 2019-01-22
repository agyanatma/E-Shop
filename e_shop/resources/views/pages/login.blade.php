@extends('layout.user')

@section('content')
    <div class="container">
        @if(count($errors)>0)
            <p class="alert alert-danger">Email or Password invalid!</p>
        @endif
    </div>
    <div class="form-group container">
        <h3>Login</h3>
        <form action="{{route('store.login')}}" method="post" class="container">
            {{csrf_field()}}
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}">
            <br/>
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Login</button>
        </form>
    </div>
@endsection