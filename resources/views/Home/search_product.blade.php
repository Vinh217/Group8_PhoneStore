@extends('layouts.home_layout')
@section('content')
<a href="{{ url('/') }}" class="btn btn-primary mt-2">Trở lại</a>
    <p>Tìm thấy {{ count($product) }} kết quả với từ khóa {{ $keyWord }}</p>
    <div class="row">
        @foreach ($product as $s)
            <div class="col-md-3 mb-2">
                <div class="border shadow rounded h-100">
                    <img width="100%" style="object-fit:cover " src="{{ asset('public/backend/uploads/product-images/'.$s->Anh) }}">
                    <div class="px-2 pb-2">
                        <a class="text-dark  text-decoration-none" href="{{ url('product-detail/' . $s->MaDT) }}">
                            {{ $s->TenDT }}
                            <b class="text-danger d-block">{{ number_format($s->DonGiaBan) }}₫</b>
                        </a>
                        <a href="{{ route('user.addToCart' ,['id' => $s->MaDT]) }}" class="btn d-block btn-warning ">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
