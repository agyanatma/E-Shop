@extends('layouts.admin')

@section('content')
    <div class="form-group container">
        <form action="{{route('update.category', $categories->id)}}" method="post" class="col-md-8" enctype="multipart/form-data">
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