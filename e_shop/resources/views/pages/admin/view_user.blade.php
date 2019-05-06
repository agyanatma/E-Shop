@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form class="col-md-10">
                            <h2><span class="fas fa-users" aria-hidden="true"></span> Viewing User<span>
                                <a href="{{ route('edit.admin',$user->id) }}" class="btn btn-sm btn-info" style="margin-left:20px"><i class="fas fa-edit"></i> Edit</a>
                            </span></h2><br>
                            <div class="card" style="margin-bottom:10px">
                                <div class="card-body" style="padding:1">
                                    <div class="row">
                                        <div class="col-sm-2 text-center">
                                            <img class="img-fluid" style="width:120px" src="{{$user->profile_image}}" alt="Card image">
                                        </div>
                                        <div class="col-sm-8">
                                            <label>Email: </label><br>
                                            <label>{{$user->email}}</label><br><br>
                                            <label>Nama: </label><br>
                                            <label>{{$user->fullname}}</label><br><br>
                                            <label>Alamat: </label><br>
                                            <label>{{$user->address}}</label><br>
                                            <label>{{$user->city}}, {{$user->postal_code}}</label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection