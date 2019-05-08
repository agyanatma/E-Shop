@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{route('store.category')}}" method="post" class="col-md-6" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h2><span class="fas fa-clipboard-list" aria-hidden="true"></span> Add Category</h2><br>
                            <label>Nama Kategori:</label>
                            <input type="text" class="form-control" name="category_name" value="{{old('category_name')}}" placeholder="Kategori">
                            <br/>
                            <label>Logo Kategori:</label><br/>
                            <input class="form-control" type="file" name="img">
                            <br/>
                            <br/>
                            <button type="submit" class="btn btn-info" style="float: right" name="action" value="create"><span class="fas fa-plus" style="margin-right:5px"></span> Tambahkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection