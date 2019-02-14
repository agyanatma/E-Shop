@extends('layouts.app')

@section('content')



@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container my-container ">
        <div style="padding:15px">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
            <form class="navbar-form" role="search" method="get" action="{{route('wishlist')}}">
                <div class="input-group">
                    <div class="nav-item" style="margin-right:10px">
                        <input type="text" class="form-control form-control-borderless"  placeholder="Search topics or keywords" name="s"
                        value="{{isset($s) ? $s : '' }}">
                    </div>
                    <div class="nav-item" style="margin-right:10px">
                        <button class="btn btn-info  " type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <form class="navbar-form" role="search" method="get" action="{{route('wishlist')}}">
                <div class="input-group">
                    <div class="nav-item" style="margin-right:10px">
                        <button class="btn btn-info  " type="submit"><i class="fas fa-cogs"></i>Change</button>
                    </div>
                </div>
            </form>
            
            </div>
        </div>
        
        <div class="row ">
                
                @if(count($wishlist) > 0)
                    @foreach ($wishlist as $row)
                    <div class="col-md-6 col-lg-3 col-sm-12" style="padding-bottom:20px; padding-top:20px; ">
                        <div class=" card-box-wishlist" >
                            <div class="card-text-box-button-delete-wishlist">
                                <a href="{{ route('deletewishlist', $row->id) }}" class="btn btn-danger " name="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            
                            <div style="max-height:150px;">
                                <a href="{{route('detailproduct', $row->product->id)}}">
                                    <img class="card-image-wishlist rounded mx-auto d-block img-fluid " style="" src="{{$row->product->images[0]->product_image}}">
                                </a>
                            </div>
                            <div class="card-body-wishlist clearfix " >
                                    <div class="card-title-box-wishlist" >
                                        <h6 class="font-weight-light text-center" style="padding-top:20px">{{$row->product->product_name}}</h6>
                                    </div>
                                    <div class="card-price-box-wishlist">
                                        <h5 class="font-weight-light ">Rp {{number_format($row->product->product_price, 0)}}</h5>
                                    </div>
                                    <div class="card-text-box-button-wishlist">
                                        @if(Auth::check() && Auth::user())
                                        <form class="" action="{{route('langsungbayar', ['id'=> $row->product->id])}}" method="POST">
                                                {{csrf_field()}}
                                                    <input type="hidden" name="user_id" value="{{$users->id}}">
                                                    <input type="hidden" name="product_id" value="{{$row->product->id}}">
                                                    <input type="hidden" name="price" value="{{$row->product->product_price}}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    {{-- <input type="hidden" name="order" value="{{$orders->id}}">   --}}
                                                    <button type="submit" id="cartBtn" class="btn btn-info btn-block ">Buy</button>
                                               
                                            </form>
                                        @else
                                        <a href="/loginaccount" id="cartBtn" class="btn btn-info "><i class="fas fa-shopping-basket"></i></a>
                                        @endif
                                    </div>
                            </div>
                            
                        </div>
                    </div>
                        @endforeach
                    @else
                        <h2>No posts found!</h2>
                    @endif
        </div>
    </div>

    
@endsection