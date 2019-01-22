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
        <form action="{{route('updateProduct', $item->id)}}" method="post" enctype="multipart/form-data">
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
            <label>Gambar:</label>
            <input type="file" name="img[]" multiple>
            <br><br>
                @foreach($images as $image)
                <div class="row">
                    <div class="column">      
                        <img class="left-block" width="200px" src="{{ URL::to('/upload/'.$image->product_image)}}"/><br>
                        <a href="{{ route('deleteImage', $image->id) }}" class="btn btn-primary" name="action" value="deleteImage">Delete</a>
                    </div>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary float-right" name="action" value="update">Update</button>
            
            </form>
    </div>
@endsection