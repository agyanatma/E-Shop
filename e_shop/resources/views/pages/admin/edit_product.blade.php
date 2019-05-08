@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{route('update.product', $item->id)}}" method="post" class="col-md-8" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h2><span class="fas fa-box-open" aria-hidden="true"></span> Editing Product</h2><br>
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
                            <button type="submit" class="btn btn-info float-right">Update</button><br><br>
                        </form>
                    </div>
                    <div class="container" style="margin-left:0px">
                        <div class="row" style="margin-bottom:50px">
                            @foreach($images as $image)
                                <div class="col-sm-2">
                                    <div class="card">
                                        <span>
                                        <img class="card-img-top" src="{{$image->product_image}}">
                                        <div class="card-img-overlay" style="padding:0">
                                            <a href="{{ route('imagedel.product', $image->id) }}" class="btn btn-xs btn-danger float-right"><i class="fas fa-times"></i></a>
                                        </div>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection