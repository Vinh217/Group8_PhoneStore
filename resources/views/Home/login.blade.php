@extends('layouts.home_layout')
@section('content')

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Login</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- Begin Login Content Area -->
<div class="page-section mb-60">
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-sm-6 col-md-6 col-xs-6  col-lg-6 mb-30">
                <!-- Login Form s-->
                <form action="{{ route('user.check') }}" method="post">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="login-form">
                        <h4 class="login-title">Login</h4>
                        <div class="row">
                            <div class="col-md-12 col-12 mb-20">
                                <label>Email Address*</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-12 mb-20">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-md-8">
                                <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                    <input type="checkbox" id="remember_me">
                                    <label for="remember_me">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                <a href="#"> Forgotten pasward?</a>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div><a href="{{ route('user.register') }}">Create new Account</a></div>

                        </div>
                    </div>
                </form>

            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
<!-- Login Content Area End Here -->
@endsection
