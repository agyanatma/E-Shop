@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0" style="margin:40px 30px 0px 30px">
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{route('registed.user')}}" method="post" class="col-md-6" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <h2><span class="fas fa-users" aria-hidden="true"></span> Add User</h2><br>
                            <label>Email:</label>
                            <input type="email" class="form-control" name="email">
                            <br/>
                            <label>Password:</label>
                            <input type="password" class="form-control" name="password">
                            <br/>
                            <label>Nama:</label>
                            <input type="text" class="form-control" name="fullname">
                            <br/>
                            <label>Alamat:</label>
                            <textarea type="text" class="form-control" name="address" rows="5" maxlength="100"></textarea>
                            <br/>
                            <label>Kota:</label>
                            <input type="text" class="form-control" name="city">
                            <br/>
                            <label>Kode Pos:</label>
                            <input type="text" class="form-control" name="postal">
                            <br/>
                            <br/>
                            <label>Gambar:</label>
                            <input class="form-control" type="file" name="img">
                            <br/>
                            <br/>
                            <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create"><span class="fas fa-plus" style="margin-right:5px"></span> Tambahkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection