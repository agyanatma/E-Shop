@extends('layouts.admin')

@section('content')
    <div class="form-group container">
        <form action="{{route('store.product')}}" method="post" class="col-md-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Produk:</label>
            <input type="text" class="form-control" name="product_name" placeholder="Produk">
            <br/>
            <label>Harga Produk:</label>
            <input type="text" class="form-control" name="product_price" placeholder="Harga">
            <br/>
            <br/>
            <label>Kategori:</label>
            <div class="input-group">
                <select class="form-control" name="category_name">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
                <a href="{{route('create.category')}}" type="button" class="btn btn-info float-right d-inline" style="margin-left:10px" name="category_add">Tambah Kategori</a>
            </div>
            <br/>
            <br/>
            <label>Deskripsi Barang:</label>
            <textarea type="text" class="form-control" name="description" rows="5" maxlength="200" placeholder="Deskripsi Barang (Max. 200 Kata)"></textarea>
            <br/>
            <br/>
            <label>Gambar:</label>
            <input class="form-control" type="file" name="img[]" multiple>
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create"><span class="fas fa-plus" style="margin-right:5px"></span> Tambahkan</button>
        </form>
    </div>
@endsection