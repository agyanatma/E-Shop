@extends('layouts.admin')

@section('content')
<<<<<<< HEAD
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
=======
>>>>>>> 29f18340538a7968056e6cd82d3d115daad239d4
    <div class="form-group container">
        <form action="{{route('update.product', $item->id)}}" method="post" class="col-md-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <label>Nama Produk:</label>
            <input type="text" class="form-control" name="product_name" value="{{$item->product_name}}" placeholder="Produk">
            <br/>
            <label>Harga Produk:</label>
            <input type="text" class="form-control" name="product_price" value="{{$item->product_price}}" placeholder="Harga">
            <br/>
            <label>Kategori:</label>
            <select name="category_name">
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{$category->id == $item->category_id ? 'selected="selected"' : ''}}>{{$category->category_name}}</option>
                @endforeach
            </select>
            <br><br>
            <label>Deskripsi Barang:</label>
            <textarea type="text" class="form-control" name="description" rows="5" maxlength="200" placeholder="Deskripsi Barang (Max. 200 Kata)">{{$item->description}}</textarea>
            <br><br>
            <label>Gambar:</label>
            <input class="form-control" type="file" name="img[]" multiple><br>
            <button type="submit" class="btn btn-primary float-right">Update</button><br><br>
        </form>
    </div>
    <div class="container">
        <div class="row">
            @foreach($images as $image)
                <div class="col-sm-2">
                    <div class="card" style="width:150px">
                        <img class="card-img-top" src="{{$image->product_image}}" alt="Card image">
                        <div class="card-img-overlay" style="padding:0">
                            <a href="{{ route('imagedel.product', $image->id) }}" class="btn btn-xs btn-danger float-right"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection