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
        <h3>Sign Up</h3>
        <form action="{{route('store.signup')}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Email:</label>
            <input type="email" class="form-control" name="email" placeholder="example@mail.com">
            <br/>
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <br/>
            <label>Nama:</label>
            <input type="text" class="form-control" name="fullname" placeholder="Nama">
            <br/>
            <label>Alamat:</label>
            <input type="text" class="form-control" name="address" placeholder="Alamat">
            <br/>
            <label>Kota:</label>
            <input type="text" class="form-control" name="city" placeholder="Kota">
            <br/>
            <label>Kode Pos:</label>
            <input type="text" class="form-control" name="postal" placeholder="Kode Pos">
            <br/>
            <label>Profile Picture:</label><br/>
            <input type="file" name="img">
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Sign Up</button>
        </form>
    </div>
@endsection