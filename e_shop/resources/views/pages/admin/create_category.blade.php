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
        <form action="{{route('storeCategory')}}" method="post" class="col-md-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Kategori:</label>
            <input type="text" class="form-control" name="category_name" value="{{old('category_name')}}" placeholder="Kategori">
            <br/>
            <label>Logo Kategori:</label><br/>
            <input class="form-control" type="file" name="img">
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create"><span class="fas fa-plus" style="margin-right:5px"></span> Tambahkan</button>
        </form>
    </div>
@endsection