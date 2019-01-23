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
        <form action="{{route('product.create')}}" method="post" class="container" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Produk:</label>
            <input type="text" class="form-control" name="product_name" placeholder="Produk">
            <br/>
            <label>Harga Produk:</label>
            <input type="text" class="form-control" name="product_price" placeholder="Harga">
            <br/>
            <label>Kategori:</label>
            <select name="category_name">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
            <a href="/category/new" type="button" class="btn btn-sm btn-success" name="category_add">Tambah Kategori</a>
            <br/>
            <br/>
            <label>Gambar:</label>
            <input type="file" name="img[]" multiple>
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Create</button>
        </form>
    </div>
@endsection