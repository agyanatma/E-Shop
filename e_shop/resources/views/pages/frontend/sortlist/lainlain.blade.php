@extends('layouts.app')

@section('content')

<div class="container-fluid my-container">
        <div style="padding:50px" >
                <div class="card-fluid bg-white" >
                    <div class="row row-centered" style="padding:20px ">
                        <div class="col-md-2 ">
                            <a href="sortmonitor"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[0]->category_image}}"></a>
                        </div>
                        <div class="col-md-2">
                            <a href="sortprocessor"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[1]->category_image}}"></a>
                        </div>
                        <div class="col-sm-2">
                            <a href="sortleptop"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[2]->category_image}}"></a>
                        </div>
                        <div class="col-md-2">
                            <a href="sortcpu"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[3]->category_image}}"></a>
                        </div>
                        <div class="col-md-2">
                            <a href="sorthdmi"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[4]->category_image}}"></a>
                        </div>
                        <div class="col-md-2" >
                            <a href="sortpowercable"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;" src="upload/{{$categories[5]->category_image}}"></a>
                        </div>
                        <div class="col-md-2 " style="padding-top:20px">
                            <a href="sortbattery"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[6]->category_image}}"></a>
                        </div>
                        <div class="col-md-2" style="padding-top:20px">
                            <a href="sortmotherboard"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[10]->category_image}}"></a>
                        </div>
                        <div class="col-sm-2" style="padding-top:20px">
                            <a href="sortkeyboard"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[7]->category_image}}"></a>
                        </div>
                        <div class="col-md-2" style="padding-top:20px">
                            <a href="sortheadphone"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[8]->category_image}}"></a>
                        </div>
                        <div class="col-md-2" style="padding-top:20px">
                            <a href="sortmouse"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;"  src="upload/{{$categories[9]->category_image}}"></a>
                        </div>
                        <div class="col-md-2" style="padding-top:20px">
                            <a href="sortprinter"><img class="rounded mx-auto d-block img-responsive " style="max-height: 50px; max-width: 100%;" src="upload/{{$categories[11]->category_image}}"></a>
                        </div>

                    </div>
                </div>
                <div class="container-fluid my-container ">
                        <div class="row">
                                @if(count($products) > 0)
                                    @foreach ($products as $row)
                                    <div class="col-md-3" style="padding-bottom:20px; padding-top:20px; ">
                                        <div class="card card-box " >
                                            <div>
                                                <a href="{{route('detailproduct', $row->id)}}"><img class="card-image rounded mx-auto d-block img-responsive " style="" src="{{ URL::to('/upload/'.$row->images[0]->product_image)}}"></a>
                                            </div>
                                            <div class="card-body clearfix" >
                                                    <h6 class="card-title-box">{{$row->product_name}}</h6>
                                                    <h5 class="card-price-box">Rp {{number_format($row->product_price, 0)}}</h5>
                                                    @if(Auth::check() && Auth::user())
                                                    <form action="{{route('addcartlangsung', ['id'=> $row->id])}}" class="card-text-box-button" method="POST" >
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="user_id" value="{{$users->id}}">
                                                        <input type="hidden" name="product_id" value="{{$row->id}}">
                                                        <input type="hidden" name="product_price" value="{{$row->product_price}}">
                                                    <input type="hidden" name="qty" value="1" id="">
                                                        <button type="submit" id="cartBtn" class="btn btn-info"><i class="fas fa-shopping-basket"></i></button>
                                                    </form>
                                                    @else
                                                    <a href="/loginaccount" id="cartBtn" class="btn btn-info"><i class="fas fa-shopping-basket"></i></a>
                                                    @endif
                                            </div>
        
                                        </div>
                                    </div>
                                        @endforeach
                                       
                                        
                                    @else
                                        <h2>No posts found!</h2>
                                    @endif
                        </div>
                    </div>
                    <div class="pagination fixed" style="" >
                        {{$products->links()}}
                    </div>
        </div>
</div>
        

@endsection

