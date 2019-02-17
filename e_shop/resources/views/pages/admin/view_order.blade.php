@extends('layouts.admin')

@section('content')
    <div class="form-group container">
        <form class="col-md-10">
            <h2><span class="fas fa-box-open" aria-hidden="true"></span> Viewing Order<span>
                <a href="" class="btn btn-sm btn-info" style="margin-left:20px"><i class="fas fa-edit"></i> Edit</a>
            </span></h2><br>
            <h3>Customer</h3>
            <div class="card" style="margin-bottom:10px">
                <div class="card-body" style="padding:1">
                    <label>Name :</label>
                    <label>{{$orders->fullname}}</label><br>
                    <label>Address :</label><br>
                    <label>{{$orders->address}}</label><br>
                    <label>City :</label>
                    <label>{{$orders->city}}</label>
                    <label>Name :</label>
                    <label>{{$orders->fullname}}</label>
                </div>
            </div>
            <div class="card" style="margin-bottom:10px">
                
            </div>
            
            <br><br>
            
        </form>
    </div>
    
@endsection