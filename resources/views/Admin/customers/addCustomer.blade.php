@extends('layouts.admin_layout')
@section('content')
<div class="card bg-light">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm người dùng</h1>
        <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
    <article class="card-body mx-auto" style="max-width: 400px;">
        <form method="POST" action="{{route('customers.store')}}">
            @csrf
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                    id="exampleName" placeholder="Full Name" name="name" value="{{ old('name') }}">

                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror"
                    id="exampleEmail" placeholder="Email" name="email" value="{{ old('email') }}">

                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                </div>
                <input type="number" class="form-control form-control-user @error('phone') is-invalid @enderror"
                    id="examplePhone" placeholder="Phone" name="phone" value="{{ old('phone') }}">

                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                    id="examplePassword" placeholder="Password" name="password" value="{{ old('password') }}">

                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control" name="cpassword" placeholder="Enter confirm password"
                    value="{{ old('cpassword') }}">
            </div> <!-- form-group// -->
             {{-- Save Button --}}
             <button type="submit" class="btn btn-primary btn-user btn-block">
                Tạo mới
            </button><!-- form-group// -->
        </form>
    </article>
</div> <!-- card.// -->


@endsection
