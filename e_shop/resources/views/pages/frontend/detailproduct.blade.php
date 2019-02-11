@extends('layouts.app')

@section('content')
{{-- <script>
        $(document).ready(function(){
        
            $('#cartBtn').click(function(){
                alert('Barang sudah bertambah');
            });
        });
        
        </script> --}}
        {{-- <div id="content">
                <div id="view">
                  <img src="{{$products->images[0]->product_image}}" alt="" />
                </div>
              <div id="thumbs">
                    <div id="nav-left-thumbs"><</div>
                    <div id="pics-thumbs">
                            @foreach($images as $item)
                        <img src="{{$item->product_image}}" alt="Nature1" />
                        @endforeach
                        
                    </div>
                    <div id="nav-right-thumbs">></div>
                </div>
            </div>
            
        </div>             --}}
<div class="container" style="padding-top:20px">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div class="row ">
                <div class="col-12 col-sm-4 col-md-5 col-lg-5 wm-zoom-container my-zoom-2 " >
                            <div class="wm-zoom-box product-section-image">
                                <img id="myimage" src="{{$products->images[0]->product_image}}" class="wm-zoom-default-img card-image-detail rounded mx-auto d-block img-responsive " data-hight-src="{{$products->images[0]->product_image}}" data-loader-src="/upload/loader.gif">
                            </div>
                            <div class="product-section-images">
                                @foreach($images as $item)
                                <div class="product-section-thumbnail selected">
                                    <img src="{{$item->product_image}}" class="wm-zoom-default-img  rounded mx-auto d-block img-responsive" style="object-fit:cover" width="70" height="70">
                                </div>
                                @endforeach
                            </div>
                            
                </div>
                <div class="col-12 col-sm-8 col-md-7 col-lg-7">
                    <h2 id="detail-product-name" class="card-detail-name text-justify">{{$products->product_name}}</h2>
                    <h4 id="detail-category-name" class="card-detail-category text-justify">{{$products->categories->category_name}}</h4>
                    <h2 id="detail-product-price" class="card-detail-price text-justify">Rp {{number_format($products->product_price, 0)}}</h2>
                    <div class="row ">
                            <form class="col-lg-10 col-md-10 col-sm-10 col-12 " action="{{route('addCart', $products->id)}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="justify-content-around  row">
                                        <div class="col-5 col-sm-6 col-md-5 col-lg-4 text-center ">
                                            <div class="input-group-prepend "> 
                                                    <button type="button" class="quantity-left-minus btn btn-info btn-number"  data-type="minus" data-field="">
                                                        <span class="fas fa-minus"></span>
                                                    </button>
                                                <input type="text" id="quantity" name="quantity" class="form-control text-center input-number" value="1" min="1" max="100">
                                                    <button type="button" class="quantity-right-plus btn btn-info btn-number" data-type="plus" data-field="">
                                                        <span class="fas fa-plus"></span>
                                                    </button>
                                            </div>
                                        </div>
                                        <div class="col-5 col-sm-6 col-md-5 col-lg-4 offset-4 text-center" style="margin-top:15px;">
                                            <div class="form-group ">
                                                <input type="hidden" name="user_id" value="{{$users->id}}">
                                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                                <input type="hidden" name="price" value="{{$products->product_price}}">
                                                <button type="submit" id="cartBtn" class="btn btn-info " ><i class="fas fa-cart-plus"></i> Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            <form class="col-lg-2 col-md-1 col-sm-2 col-12 " action="{{route('langsungbayar')}}" method="GET">
                                {{csrf_field()}}
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{$users->id}}">
                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                    <input type="hidden" name="product_price" value="{{$products->product_price}}">
                                    <input type="hidden" name="quantity" value="1">
                                    {{-- <input type="hidden" name="order" value="{{$orders->id}}">   --}}
                                    <button type="submit" id="cartBtn" class="btn btn-info">Checkout</button>
                                </div>
                            </form> 
                    </div>
                   
                        <div class=" card-detail-description">
                            <h5 class="text-uppercase" id="description-title" style="margin:10px"><i class="fas fa-list-alt"></i> Information Product</h5>
                            <p class="text-justify" id="description-detail">{{$products->description}}></p>
                        </div>
                    
                    
                </div>
        </div>
        <br>
        <h1> Random Product</h1>
        <div class="row" style="padding-bottom:20px">
                @if(count($productrandom) > 0)
                    @foreach ($productrandom as $row)
                    <div class="col-md-4 col-lg-2 col-sm-6 col-12" style="padding-bottom:20px; padding-top:20px; ">
                        <div class=" card-box-detail " >
                            <div style="max-height:80px">
                                <a href="{{route('detailproduct', $row->id)}}"><img class="card-image-random-detail rounded mx-auto d-block img-responsive " style="" src="{{ $row->images[0]->product_image}}"></a>
                            </div>
                            <div class="card-body-detail clearfix" >
                                    <div class="card-title-box-detail">
                                        <h6 id="random-title-product-name" class="font-weight-light text-justify" class="text-justify">{{$row->product_name}}</h6>
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