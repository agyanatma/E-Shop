@extends('layout.admin')

@section('content')
    <div class="container">
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{$error}}</p>
            @endforeach
        @endif
    </div>
    <div class="form-group container">
        <form action="{{route('storeCategory')}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Kategori:</label>
            <input type="text" class="form-control" name="category_name" value="@yield('editName')" placeholder="Kategori">
            <br/>
            <label>Logo Kategori:</label><br/>
            <input type="file" name="img">
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" style="float: right" name="add" value="Tambahkan">
        </form>
    </div>
@endsection
