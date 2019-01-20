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
        <form action="{{route('newCategory')}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Produk:</label>
            <input type="text" class="form-control" name="product_name" value="@yield('editName')" placeholder="Produk">
            <br/>
            <label>Harga Produk:</label>
            <input type="text" class="form-control" name="product_price" value="@yield('editPrice')" placeholder="Harga">
            <br/>
            <label>Kategori:</label>
            <select name="category_name">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" style="float: right" name="create" value="Create">
        </form>
    </div>
@endsection