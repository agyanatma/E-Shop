@extends('layouts.app')

@section('content')


<div class="container-fluid my-container " style="padding-left:4%;padding-right:4%">
        <div style="padding:15px">
            <div class="row">
            <form class="navbar-form" role="search" method="get" action="{{route('searchwishlist')}}">
                <div class="input-group">
                    <div class="nav-item" style="margin-right:10px">
                        <input type="text" class="form-control form-control-borderless"  placeholder="Search topics or keywords" name="title">
                    </div>
                    <div class="nav-item" style="margin-right:10px">
                        <button class="btn btn-info  " type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <form class="navbar-form" role="search" method="get" href="{{route('wishlist')}}" action="{{route('wishlist')}}">
                <div class="input-group">
                    <div class="nav-item" style="margin-right:10px">
                        <button class="btn btn-info  " type="submit"><i class="fas fa-undo"> Back</i></button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif
        @if(count($errors)>0)
            <p class="alert alert-danger">Please Try Again</p>
        @endif
        <div class="row " >
               
                @if(count($wishlist) > 0)
                    @foreach ($wishlist as $row)
                    <div class="col-md-6 col-lg-3 col-sm-12" style="padding-bottom:20px; padding-top:20px; ">
                        <div class=" card-box-wishlist" >
                            <div style="max-height:150px;">
                                <a href="{{route('detailproduct', $row->product->id)}}">
                                    <img class="card-image-wishlist rounded mx-auto d-block img-fluid " style="" src="{{$row->product->images[0]->product_image}}">
                                </a>
                            </div>
                            <div class="card-text-box-button-delete-wishlist">
                                <a href="{{ route('deletewishlist', $row->id) }}" class="btn btn-danger " name="delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                            <div class="card-body-wishlist clearfix " >
                                    <div class="card-title-box-wishlist" >
                                        <h5 class="font-weight-light text-center" style="padding-top:20px">{{$row->product->product_name}}</h5>
                                    </div>
                                    <div class="card-price-box-wishlist">
                                        <h5 class="font-weight-bold text-center "style="padding-top:20px">Rp. {{number_format($row->product->product_price,0)}}</h5>
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
                                                    <button type="submit" id="cartBtn" class="btn btn-success btn-block "><i class="fas fa-handshake"> Buy</i></button>
                                            </form>
                                        @else
                                        <a href="/loginaccount" id="cartBtn" class="btn btn-success "><i class="fas fa-handshake"> Buy</i></a>
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
        <div class="pagination fixed" style="margin:4%" >
                {{$wishlist->links()}}
        </div>
    </div>

    
@endsection