@extends('layout.app')

@section('content')
    <div class="container">
        @if(\Session::has('alert'))
            <div class="alert alert-danger">
                <div>{{Session::get('alert')}}</div>
            </div>
        @endif
        @if(\Session::has('alert-success'))
            <div class="alert alert-success">
                <div>{{Session::get('alert-success')}}</div>
            </div>
        @endif
    </div>
    <div class="form-group container">
        <h3>Login</h3>
        <form action="{{route('store.login')}}" method="post" class="container">
            {{csrf_field()}}
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="example@mail.com">
            <br/>
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Login</button>
        </form>
    </div>
@endsection