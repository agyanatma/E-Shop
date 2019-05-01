@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form class="col-md-10">
                        <h2><span class="fas fa-clipboard-list" aria-hidden="true"></span> Viewing Category<span>
                                <a href="{{ route('edit.category',$categories->id) }}" class="btn btn-sm btn-info" style="margin-left:20px"><i class="fas fa-edit"></i> Edit</a>
                            </span></h2><br>
                            <div class="card" style="margin-bottom:10px">
                                <div class="card-body" style="padding:1">
                                    <label>Nama Kategori: </label><br>
                                    <label>{{$categories->category_name}}</label>
                                </div>
                            </div>
                            <div class="card" style="margin-bottom:10px">
                                <div class="card-body">
                                    <label>Logo Kategori:</label><br>
                                    <span><img class="img" style="height:150px" src="{{$categories->category_image}}" alt="Card image"></span>
                                </div>
                            </div>
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection