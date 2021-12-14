@extends('layouts.navbar')
@section('title','Register')
@section('content')
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100 mt-5">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
				
					<div class="cardx fat mt-4">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" autocomplete="off" action="{{ route('register') }}">

								@if ( Session::get('success'))
									 <div class="alert alert-success">
										 {{ Session::get('success') }}
									 </div>
								@endif
								@if ( Session::get('error'))
									 <div class="alert alert-danger">
										 {{ Session::get('error') }}
									 </div>
								@endif
                                @csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name"  autofocus placeholder="Enter name" value="{{ old('name') }}">
									<span class="text-danger"><p class="mt-2"><b>@error('name'){{ $message }}@enderror</b></p></span>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email"  placeholder="Enter email" value="{{ old('email') }}">
									<span class="text-danger"><p class="mt-2"><b>@error('email'){{ $message }}@enderror</b></p></span>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password"  data-eye placeholder="Enter password">
									<span class="text-danger"><p class="mt-2"><b>@error('password'){{ $message }}@enderror</b></p></span>
								</div>
                                <div class="form-group">
									<label for="password-confirm">Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" data-eye placeholder="Enter confirm password">
									<span class="text-danger"><p class="mt-2"><b>@error('name'){{ $message }}@enderror</b></p></span>
                                    
								</div>


								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="{{route('login')}}">Login</a>
								</div>
							</form>
						</div>
					</div>
			
				</div>
			</div>
		</div>
	</section>

@endsection