@extends('layouts.app')

@section('content')
<div  class="container-fluid my-container">
        <div class="col-md-10 ">
            <div class="form-group container">
                    <form method="post" class="container" enctype="multipart/form-data">
                        
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fas fa-box"></i></span>
                            <input  type="text" class="form-control" id="product_name" name="product_name" value="@yield('editName')" placeholder="Produk">
                        </div>
                
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></i></span>
                            <input type="text" class="form-control" name="product_price" value="@yield('editPrice')" placeholder="Harga">
                        </div>
                
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <select name="category_name">

                            </select>
                        </div>
                
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="far fa-image"></i></span>
                            <input type="file" name="img[]" multiple>
                        </div>
                        
                        <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" class="btn btn-primary" style="float: right" name="create" value="Create">
                    </form>
            </div>
        </div>
    </div>
@endsection
        
        
       
