@extends('layouts.app')

@section('content')


<div class="container-fluid" style="padding-top:20px">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div class="row justify-content-between">
                <div class="col-12 col-sm-5 col-md-6 col-lg-6 ">
                    <div style="max-height:400px">
                        <img id="myimage" src="{{$products->images[0]->product_image}}" class="card-image-detail rrounded mx-auto d-block img-fluid"  data-hight-src="{{$products->images[0]->product_image}}" data-loader-src="/upload/loader.gif">
                    </div>
                    <div class="product-section-images">
                        @foreach($images as $item)
                        <div class="row">
                            <div class="product-section-thumbnail selected">
                                <img src="{{$item->product_image}}" class="rounded mx-auto d-block img-responsive" style="object-fit:cover" width="70" height="70">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-7 col-md-6 col-lg-6">
                    <div class="card-detail-body">
                        <div class="card-detail-name-body" style=" border-bottom: solid 1px #e0e0e0;">
                            <h2 class="card-detail-name " style="">{{$products->product_name}}</h2>
                        </div>
                        <div class="" style="padding-top:30px">
                            <div class="">
                                <h3 id="detail-product-price" class="card-detail-price text-left"><strong>Rp.{{number_format($products->product_price, 0)}}</strong></h3>
                            </div> 
                        </div>
                                {{-- sudahlogin --}}
                                @if(Auth::check() && Auth::user())
                                    <form action="{{route('addCart', $products->id)}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="row justify-content-between" style="padding-top:20px;">
                                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 text-center">
                                                    <div class="input-group-prepend "> 
                                                            <button type="button" class="quantity-left-minus btn " style="color:black"  data-type="minus" data-field="">
                                                                <span class="fas fa-minus"></span>
                                                            </button>
                                                        <input type="text" id="quantity" name="quantity" class="form-control text-center input-number" style="border:none" value="1" min="1" max="100">
                                                            <button type="button" class="quantity-right-plus btn " style="color:black" data-type="plus" data-field="">
                                                                <span class="fas fa-plus"></span>
                                                            </button>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 text-center" >
                                                        <input type="hidden" name="user_id" value="{{$users->id}}">
                                                        <input type="hidden" name="product_id" value="{{$products->id}}">
                                                        <input type="hidden" name="price" value="{{$products->product_price}}">
                                                        <button type="submit" id="cartBtn" class="btn btn-info btn-block " > Add to Cart</button>
                                                </div>
                                            </div>
                                    </form>
                                @else
                                {{-- Belumlogin --}}
                                                <div class="justify-content-between  row" style="padding-top:20px">
                                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 text-center ">
                                                        <div class="input-group-prepend "> 
                                                            <button type="button" class="quantity-left-minus btn btn-info "data-type="minus" data-field="">
                                                                <span class="fas fa-minus"></span>
                                                            </button>
                                                                <input type="text" id="quantity" name="quantity" class="form-control text-center input-number" style="border:none" value="1" min="1" max="100">
                                                            <button type="button" class="quantity-right-plus btn btn-info "  data-type="plus" data-field="">
                                                                <span class="fas fa-plus"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 text-center" style="margin-top:15px;">
                                                        <a href="/loginaccount" id="cartBtn" class="btn btn-info btn-block ">Add to Cart</a>
                                                    </div>
                                                </div>
                                @endif
                        
                        <div class="row justify-content-between" style="padding-top:30px;">
                            {{-- sudahlogin --}}
                            @if(Auth::check() && Auth::user())
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center ">
                                <form action="{{route('addWishlist', $products->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                    <button type="submit" id="cartBtn" class="btn btn-wishlist btn-block  " > Add to Wishlist</button>
                                </form>
                            </div>
                            {{-- Belumlogin --}}
                            @else
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center ">
                                <a href="/loginaccount" id="cartBtn" class="btn btn-wishlist btn-block ">Add to Wishlist</a>
                            </div>
                            @endif
                            {{-- sudahlogin --}}
                            @if(Auth::check() && Auth::user())
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center ">
                                <form  action="{{route('langsungbayar', $products->id)}}" method="POST">
                                    {{csrf_field()}} 
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="product_id" value="{{$products->id}}">
                                        <input type="hidden" name="price" value="{{$products->product_price}}">
                                        <input type="hidden" name="quantity" value="1">
                                        {{-- <input type="hidden" name="order" value="{{$orders->id}}">   --}}
                                        <button type="submit" id="cartBtn" class="btn btn-dark btn-block">Buy Now</button>
                                </form> 
                            </div>
                            {{-- Belumlogin --}}
                            @else
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4 text-center ">
                                <a href="/loginaccount" id="cartBtn" class="btn btn-dark btn-block ">Buy Now</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-detail-description-body" style="padding-top:50px;  ">
                        <div class=" card-detail-description">
                            <h5 class="text-uppercase" id="description-title" style="margin:10px; border-bottom: solid 1px #e0e0e0;">description</h5>
                            <p class="text-justify" id="description-detail">{{$products->description}}></p>
                        </div>
                    </div>
                </div>
            </div>
        <div class="card-detail-product-title-random">
            <h2 style="padding-top:100px">Other Product</h2>
        </div>
        <div class="row" style="padding-bottom:20px" >
                @if(count($productrandom) > 0)
                    @foreach ($productrandom as $row)
                    <div class="col-md-4 col-lg-2 col-sm-6 col-12" style="padding-bottom:20px; padding-top:20px; ">
                        <div class=" card-box-detail " >
                            <div style="max-height:120px">
                                <a href="{{route('detailproduct', $row->id)}}"><img class="card-image-random-detail rounded mx-auto d-block img-fluid " style="" src="{{ $row->images[0]->product_image}}"></a>
                            </div>
                            <div class="card-body-detail clearfix" >
                                    <div class="card-title-box-detail">
                                        <h6 id="random-title-product-name" class="font-weight-light " >{{$row->product_name}}</h6>
                                    </div>
                                    <div class="card-price-box-detail ">
                                        <h6 class="text-center">Rp {{number_format($row->product_price, 0)}}</h6>
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

<script type="text/javascript">
(function(){
        const myimage = document.querySelector('#myimage');
        const images = document.querySelectorAll('.product-section-thumbnail');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e){
            //myimage.classList.remove('active');
            //myimage.addEventListener('transitioned', () =>{
                myimage.src = this.querySelector('img').src;
                myimage.classList.add('active');
            //})
            
            images.forEach((element) => element.classList.remove('selected'));
            this.classList.add('selected');
        }
    })();
    $(document).ready(function(){
        $('.my-zoom-1').WMZoom();
        $('.my-zoom-2').WMZoom({
            config : {
                inner : true
            }
        });
    });

    $(document).ready(function() {
    // Initialisation du plugin jQuery
    $('#view').setZoomPicture({
	thumbsContainer: '#pics-thumbs',
	prevContainer: '#nav-left-thumbs',
	nextContainer: '#nav-right-thumbs',
	zoomContainer: '#zoom',
	zoomLevel: 2,
    }); 
});
</script>
@endsection