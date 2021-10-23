@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sửa người dùng</h1>
        <a href="{{route('customers.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('Admin.common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa người dùng</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('customers.update',['customer' => $customer->id])}}">
                @csrf
                @method('PUT')
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Name</label>
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
                    </div>


                    {{-- Email --}}
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Email</label>
                        <input type="text"
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleEmail"
                            placeholder="Email"
                            name="email"
                            value="{{ old('email') ? old('email') : $customer->email}}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Phone</label>
                        <input type="number"
                            class="form-control form-control-user @error('phone') is-invalid @enderror"
                            id="examplePhone"
                            placeholder="Phone"
                            name="phone"
                            value="{{ old('phone') ? old('phone') : $customer->phone}}">

                        @error('phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-sm-12 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Password</label>
                        <input type="password"
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            id="examplePassword"
                            placeholder="Password"
                            name="password"
                            value="{{ old('password') ? old('password') : $customer->password}}">

                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Cập nhật
                </button>

            </form>
        </div>
    </div>

</div>
@endsection
