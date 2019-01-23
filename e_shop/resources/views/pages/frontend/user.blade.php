@extends('layouts.app')

@section('title')
Shopping Cart
@endsection

@section('content')

    <div class="container-fluid my-container">
        <div class="panel">
                <div class="panel-header">
                        <div class="jumbotron" style="padding:0px; margin:auto">
                            <div class="row ">
                                <div class="col-md-5 bg-default">
                                    <img src="https://image.freepik.com/free-vector/black-baroque-shield-elements-vector_53876-76061.jpg" style="margin:auto; max-height:200px; max-width:80% "  class="rounded mx-auto d-block img-responsive img-fluid" class="img-circle" alt="..." >
                                </div>
                                <div class="col-md-6">
                                    <h1>Welcome</h1>
                                    <p>...</p>
                                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="panel-body">
                    <div class="row my-row bg-warning">
                        <div class="col-md-12">
                                <form action="{{route('store.registeraccount')}}" method="post" class="container" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    
                                    <label>Email:</label>
                                    <input type="email" class="form-control" name="email" placeholder="example@mail.com">
                                    <br/>
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <br/>
                                    <label>Nama:</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Nama">
                                    <br/>
                                    <label>Alamat:</label>
                                    <input type="text" class="form-control" name="address" placeholder="Alamat">
                                    <br/>
                                    <label>Kota:</label>
                                    <input type="text" class="form-control" name="city" placeholder="Kota">
                                    <br/>
                                    <label>Kode Pos:</label>
                                    <input type="text" class="form-control" name="postal" placeholder="Kode Pos">
                                    <br/>
                                    <label>Profile Picture:</label><br/>
                                    <input type="file" name="img">
                                    <br/>
                                    <br/>
                                    <button type="submit" class="btn btn-primary" style="float: right" name="action" value="create">Ubah</button>
                                    
                                </form>     
                        </div>
                    </div>
                </div>
        </div>
    </div>
</nav>
</body>
</html>

@endsection

