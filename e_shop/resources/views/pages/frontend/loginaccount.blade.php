@extends('layouts.app')

@section('content')
<style>
body {
 /* Location of the image */
  background-image: url(/upload/);
  
  /* Image is centered vertically and horizontally at all times */
  background-position: center center ;
  background-position-y: 10px;
  /* Image doesn't repeat */
  background-repeat: no-repeat;
  
  /* Makes the image fixed in the viewport so that it doesn't move when 
     the content height is greater than the image height */
  background-attachment: fixed;
  
  /* This is what makes the background image rescale based on its container's size */
  background-size: contain;
  
  /* SHORTHAND CSS NOTATION
   * background: url(background-photo.jpg) center center cover no-repeat fixed;
   */
}
</style>
@if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{$error}}</li>
        @endforeach
    </ul>
@endif
<div class="container h-100" >
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="upload/icon_eshopprimary.png" class="brand_logo mx-auto d-block img-responsive img-fluid" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
                    <form action="{{route('store.loginaccount')}}" method="post" class="container">
                        {{csrf_field()}}
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
                            <p class="alert alert-danger">Input email and password to login</p>
                        @endif      
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_user" value="{{old('email')}}" placeholder="example@mail.com">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass"  placeholder="password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" class="btn btn-dark btn-block" style="float: center; " name="action" value="create"><i class="fas fa-sign-in-alt"> Login</i></button>
                        </div>
					</form>
				</div>
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="{{ route('registeraccountPage') }}" class="ml-2">Sign Up</a>
					</div>
				</div>
			</div>
		</div>
	</div>
        {{-- <div class="container-fluid" style="padding-left:4%;padding-right:4%;padding-top:4%;">
            <div class="row" >
                <div class="col-md-6" >
                    <img class="rounded mx-auto d-block img-responsive img-fluid" style="height: auto; max-width: 100%;" width="500px" src="upload/Logo-edit.png">
                </div>
                <div class="col-md-6 login-form "  >
            <div class="card card-login " style=" border: solid 5px #e0e0e0; background:#f2f2f2; height:500px"> 
                 
                        <div class="form-group ">
                            <h2 class="card-title " class="text-center"><strong>Sign In</strong></h2>
                            <form action="{{route('store.loginaccount')}}" method="post" class="container">
                                {{csrf_field()}}
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
                                    <p class="alert alert-danger">Masukkan email dan password untuk masuk</p>
                                @endif
                                <div class="form-group" style="padding-top:10px">
                                <h6>Email:</h6>
                                <input type="email" class="form-control" name="email" placeholder="example@mail.com" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                <h6>Password:</h6>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                <div>
                                <button type="submit" class="btn btn-info btn-block" style="float: center" name="action" value="create"><i class="fas fa-sign-in-alt"> Login</i></button>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>                                 --}}
@endsection