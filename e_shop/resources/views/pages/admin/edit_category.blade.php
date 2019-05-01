@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{route('update.category', $categories->id)}}" method="post" class="col-md-6" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h2><span class="fas fa-clipboard-list" aria-hidden="true"></span> Editing Category</h2><br>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection