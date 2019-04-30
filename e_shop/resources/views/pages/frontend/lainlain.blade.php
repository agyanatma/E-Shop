@extends('layouts.app')

@section('content')
<style>
    #slider,
.wrap,
.slide-content {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
  width: 100%;
  height: 300px;
  overflow-x: hidden;
}

.wrap {
  position: relative;
}

.slide {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.slide1 {
  background-image: url("https://images.dazeinfo.com/wp-content/uploads/2018/06/mobile-ecommerce-shopping.jpg");
}
.slide2 {
  background-image: url("https://cdn.shopify.com/s/files/1/2006/5615/articles/TechniMobili-Blog-5RulesForBuying.jpg?v=1510251949");
}
.slide3 {
  background-image: url("https://amhsnewspaper.com/wp-content/uploads/2019/02/shop.jpg");
}

.slide-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.slide-content span {
  font-size: 5rem;
  color: #fff;
}

.arrow {
  cursor: pointer;
  position: absolute;
  top: 50%;
  margin-top: -35px;
  width: 0;
  height: 0;
  border-style: solid;
}

#arrow-left {
  border-width: 30px 40px 30px 0;
  border-color: transparent #fff transparent transparent;
  left: 0;
  margin-left: 30px;
}

#arrow-right {
  border-width: 30px 0 30px 40px;
  border-color: transparent transparent transparent #fff;
  right: 0;
  margin-right: 30px;
}
</style>
                <div class="container-fluid my-container" style="padding-left:4%;padding-right:4%;padding-top:2%;">
                  <div class="wrap">
                    <div id="arrow-left" class="arrow"></div>
                    <div id="slider">
                      <div class="slide slide1">
                        <div class="slide-content">
                          <span src="/upload/banner-1.png"></span>
                        </div>
                      </div>
                      <div class="slide slide2">
                        <div class="slide-content">
                          <span src="/upload/banner-2.png"></span>
                        </div>
                      </div>
                      <div class="slide slide3">
                        <div class="slide-content">
                          <span src=""></span>
                        </div>
                      </div>
                    </div>
                    <div id="arrow-right" class="arrow"></div>
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
                <p class="alert alert-danger">Error</p>
                @endif
                <div class="card-fluid " style="margin-top:2%">
                    <div class="row row-centered " >
                        @if(count($categories) > 0)
                        @foreach ($categories as $category)
                                <div class="col-md-4 col-lg-2 col-sm-6 col-6 category" style="padding-bottom:10px; padding-top:30px; ">
                                    <a href="{{route('sortbycategory', ['id'=> $category->id])}}"><img class="rounded mx-auto d-block img-fluid " style="max-height: 50px; max-width: 100%;"  src="{{$category->category_image}}"></a>
                                    @if($category->id==1)
                                    <h5>Computer</h5>
                                    @endif
                                    @if($category->id==2)
                                    <h5>Processor</h5>
                                    @endif
                                    @if($category->id==3)
                                    <h5>Leptop</h5>
                                    @endif
                                    @if($category->id==4)
                                    <h5>CPU</h5>
                                    @endif
                                    @if($category->id==5)
                                    <h5>VGA</h5>
                                    @endif
                                    @if($category->id==6)
                                    <h5>Charger</h5>
                                    @endif
                                    @if($category->id==7)
                                    <h5>Battery</h5>
                                    @endif
                                    @if($category->id==8)
                                    <h5>Keyboard</h5>
                                    @endif
                                    @if($category->id==9)
                                    <h5>Headset</h5>
                                    @endif
                                    @if($category->id==11)
                                    <h5>Mouse</h5>
                                    @endif
                                    @if($category->id==12)
                                    <h5>Motherboard</h5>
                                    @endif
                                    @if($category->id==13)
                                    <h5>Printer</h5>
                                    @endif
                                </div>
                        @endforeach
                        @endif
                                                       
                    </div>
                </div>
                <div class="row" >
                        @if(count($products) > 0)
                            @foreach ($products as $row)
                            <div class="col-md-6 col-lg-3 col-sm-12" style="padding-bottom:20px; padding-top:20px; ">
                                <div class=" card-box " >
                                    <div style="align-self-center">
                                        <div style="max-height:150px">
                                            <a href="{{route('detailproduct', $row->id)}}">
                                                <img class="card-image rounded mx-auto d-block img-fluid " style="" src="{{ $row->images[0]->product_image}}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body clearfix " >
                                            <div class="card-title-box">
                                                <h5 class="text-center" >{{$row->product_name}}</h5>
                                            </div>
                                            <div class="row clearfix  clearfix" >
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                    <div class="card-price-box " >
                                                        <h5 class="font-weight-bold text-left " >Rp {{number_format($row->product_price,0)}}</h5>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                        <div class="clearfix card-text-box-button-index-wishlist" style="float:right"> 
                                                            @if(Auth::check() && Auth::user())
                                                                <form action="{{route('addWishlist', ['id'=> $row->id])}}" method="POST">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                                        <input type="hidden" name="product_id" value="{{$row->id}}">
                                                                        <button type="submit" id="cartBtn" class="btn btn-danger  mx-2" style="color:white"><i class="fas fa-heart"></i></button>
                                                                </form>
                                                                @else
                                                                    <a href="/loginaccount" id="cartBtn" class="btn btn-danger mx-2" style="color:white"><i class="fas fa-heart"></i></a>
                                                                @endif
                                                        </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                                    <div class="card-text-box-button" style="float:right">
                                                        @if(Auth::check() && Auth::user())
                                                        <form action="{{route('addcartlangsung', ['id'=> $row->id])}}" method="POST" >
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                            <input type="hidden" name="product_id" value="{{$row->id}}">
                                                            <input type="hidden" name="price" value="{{$row->product_price}}">
                                                            <input type="hidden" name="qty" value="1" id="">
                                                            <button type="submit" id="cartBtn" class="btn btn-info mx-auto"><i class="fas fa-shopping-basket"></i></button>
                                                        </form>
                                                        @else
                                                        <a href="/loginaccount" id="cartBtn" class="btn btn-info mx-auto"><i class="fas fa-shopping-basket"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
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
                        {{$products->links()}}
                </div>
            </div>
</div>
        
<script>
let sliderImages = document.querySelectorAll(".slide"),
  arrowLeft = document.querySelector("#arrow-left"),
  arrowRight = document.querySelector("#arrow-right"),
  current = 0;

// Clear all images
function reset() {
  for (let i = 0; i < sliderImages.length; i++) {
    sliderImages[i].style.display = "none";
  }
}

// Init slider
function startSlide() {
  reset();
  sliderImages[0].style.display = "block";
}

// Show prev
function slideLeft() {
  reset();
  sliderImages[current - 1].style.display = "block";
  current--;
}

// Show next
function slideRight() {
  reset();
  sliderImages[current + 1].style.display = "block";
  current++;
}

// Left arrow click
arrowLeft.addEventListener("click", function() {
  if (current === 0) {
    current = sliderImages.length;
  }
  slideLeft();
});

// Right arrow click
arrowRight.addEventListener("click", function() {
  if (current === sliderImages.length - 1) {
    current = -1;
  }
  slideRight();
});

startSlide();
    
</script>
@endsection

