@extends('layouts.navbar')
@section('title', 'Login')
@section('content')

    <body class="my-login-page">
        <section class="h-100 mt-5">
            <div class="container h-100 mt-5">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">

                        <div class="cardx fat mt-5">
                            <div class="card-body">
                                <h4 class="card-title">Login</h4>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul class="p-0 m-0" style="list-style: none;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" class="my-login-validation" autocomplete="off"
                                    action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control" name="email" autofocus
                                            placeholder="Enter email">
                                        <span class="text-danger">
                                            <p class="mt-2"><b>@error('email'){{ $message }}@enderror</b></p>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password
                                                <a href="{{ route('password.request') }}" class="float-right ml-5">
                                                    Forgot Password?
                                                </a>
                                            </label>
                                            <input id="password" type="password" class="form-control" name="password" data-eye
                                                placeholder="Enter password">
                                            <span class="text-danger">
                                                <p class="mt-2"><b>@error('password'){{ $message }}@enderror</b>
                                                    </p>
                                                </span>
                                            </div>

                                           

                                            <div class="form-group m-0">
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    Login
                                                </button>
                                            </div>
                                            <div class="mt-4 text-center">
                                                Don't have an account? <a href="{{ route('register') }}">Create One</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            @endsection
