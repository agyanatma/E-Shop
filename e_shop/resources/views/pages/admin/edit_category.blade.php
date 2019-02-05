@extends('layout.admin')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{$error}}</p>
            @endforeach
        @endif
    </div>
    <div class="form-group container">
        <form action="{{route('updateCategory', $categories->id)}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Kategori:</label>
            <input type="text" class="form-control" name="category_name" value="{{$categories->category_name}}" placeholder="Kategori">
            <br/>
            <label>Logo Kategori:</label><br/>
            <input type="file" name="img">
            <br><br>
            <div class="row">
                <div class="col-sm-2">
                    <img class="img-fluid" height="100px" src="{{$categories->category_image}}"/><br>
                    
                </div>
            </div>
            <br/>
            <input type="submit" class="btn btn-primary" style="float: right" name="update" value="Update">
        </form>
    </div>
@endsection