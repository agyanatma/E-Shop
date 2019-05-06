@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{route('edited.admin', $user->id)}}" method="post" class="col-md-6" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h2><span class="fas fa-users" aria-hidden="true"></span> Editing User</h2><br>
                            <label>Nama:</label>
                            <input type="text" class="form-control" name="fullname" value="{{$user->fullname}}">
                            <br/>
                            <label>Alamat:</label>
                            <textarea type="text" class="form-control" name="address" rows="5" maxlength="100">{{$user->address}}</textarea>
                            <br/>
                            <label>Kota:</label>
                            <input type="text" class="form-control" name="city" value="{{$user->city}}">
                            <br/>
                            <label>Kode Pos:</label>
                            <input type="text" class="form-control" name="postal" value="{{$user->postal_code}}">
                            <br/>
                            <br/>
                            <label>Gambar:</label><br>
                            <input type="file" name="img">
                            <br><br>
                            <div class="row">
                                <div class="col-sm-2">
                                    <img class="img-fluid" height="100px" src="{{$user->profile_image}}"/><br>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection