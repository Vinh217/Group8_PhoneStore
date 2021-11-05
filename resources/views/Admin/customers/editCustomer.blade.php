@extends('layouts.admin_layout')
@section('content')
<div class="card bg-light">
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa người dùng</h1>
        <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
    <article class="card-body mx-auto" style="max-width: 400px;">
        <form method="POST" action="{{route('customers.update',['customer' => $customer->id])}}">
            @csrf
            @method('PUT')
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input
                type="text"
                class="form-control form-control-user @error('name') is-invalid @enderror"
                id="exampleName"
                placeholder="Name"
                name="name"
                value="{{ old('name') ? old('name') : $customer->name}}">

            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input type="text"
                class="form-control form-control-user @error('email') is-invalid @enderror"
                id="exampleEmail"
                placeholder="Email"
                name="email"
                value="{{ old('email') ? old('email') : $customer->email}}">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                </div>
                <input type="number"
                class="form-control form-control-user @error('phone') is-invalid @enderror"
                id="examplePhone"
                placeholder="Phone"
                name="phone"
                value="{{ old('phone') ? old('phone') : $customer->phone}}">


                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div> <!-- form-group// -->
             {{-- Save Button --}}
             <button type="submit" class="btn btn-primary btn-user btn-block">
                Lưu
            </button><!-- form-group// -->
        </form>
    </article>
</div> <!-- card.// -->


@endsection
