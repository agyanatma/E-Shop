@extends('layouts.app')

@section('content')

    <div class="container-fluid my-container">
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
    <nav class="navbar-default ">
            <div class="container-fluid">
                <div class="panel">
                    <div class="panel-body">
                            <div class="row ">
                                    <div class="col-md-6" style="padding:20px; margin:center;">
                                        <div class="card" style="padding:20px;">
                                          <img src="" alt="...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group container-fluid">
                                                    <h3 class="text-center">Login</h3>
                                                    <form action="{{route('store.loginaccount')}}" method="post" class="container">
                                                        {{csrf_field()}}
                                                        <div>
                                                        <label>Email:</label>
                                                        <input type="email" class="form-control" name="email" placeholder="example@mail.com">
                                                        <br>
                                                        </div>
                                                        <div>
                                                        <label>Password:</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                                        <br>
                                                        </div>
                                                        <div >
                                                        <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Login</button>
                                                        </div>
                                                    </form>
                                                </div>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
    </nav>
@endsection