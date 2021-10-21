@extends('layouts.admin_layout')
@section('content')
<!-- Main content -->
<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Kho điện thoại mã {{ $id }}</h3>
                </div>
                <!-- /.card-header -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Màu</th>
                            <th>Số lượng</th>
                            <th>Đơn giá nhập</th>
                            <th>Đơn giá bán</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quantity as $item)
                        <tr>
                            <td>{{ $item-> Mau}}</td>
                            <td>
                                @if($item-> SoLuong == 0)
                                <span class="text-danger">Hết hàng</span>
                                @else
                                {{ $item-> SoLuong}}
                                @endif
                            </td>
                            <td>{{ $item->DonGiaNhap}}</td>
                            <td>
                                {{ $item->DonGiaBan}}
                            </td>
                            <td>
                                {{-- <a href="{{ url('edit-quantity/'.$item->MaDT) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a> --}}
                                <a href="#" onclick="return EditSupplier('{{$item->MaDT  }}',this)" class="btn btn-primary">Edit</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <!-- /.card -->


        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ url('insert-quantity/'.$id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" class="form-control" id="txtMaDT" name="txtMaDT" value="{{ $id }}">
                            <div class="form-group row">
                                <label for="txtMau" class="col-sm-2 col-form-label">Màu sắc</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="txtMau" name="txtMau" value="{{ old('txtMau') }}" placeholder="Màu sắc">
                                    @error('txtMau')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtSoLuong" class="col-sm-2 col-form-label">Số lượng</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="txtSoLuong" name="txtSoLuong" value="{{ old('txtSoLuong') }}" placeholder="Số lượng">
                                    @error('txtSoLuong')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtDonGiaNhap" class="col-sm-2 col-form-label">Giá nhập</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="txtDonGiaNhap" name="txtDonGiaNhap" value="{{ old('txtDonGiaNhap') }}" placeholder="Đơn giá nhập">
                                    @error('txtDonGiaNhap')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtDonGiaBan" class="col-sm-2 col-form-label">Giá bán</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="txtDonGiaBan" name="txtDonGiaBan" value="{{ old('txtDonGiaBan') }}" placeholder="Đơn giá bán">
                                    @error('txtDonGiaBan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="">
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.card-body -->


                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('js')
<script type="text/javascript">
    @if(count($errors) > 0)
    toastr.options = {
        "timeOut": 5000
            // , "progressBar": true
        , "preventDuplicates": true
        , "closeButton": true
    , }
    toastr.error($('#error_message').html());
    @endif

    $('.summernote').summernote({
        disableGrammar: true
    });

    function EditSupplier(id, ctl) {
        // console.log($(ctl).text());
        // console.log(id);
        if ($(ctl).text() == 'Edit') {
            $(ctl).text('Save');
            for (var i = 0; i < 3; i++) {
                var val = $(ctl).parent().parent().children('td:nth-child(' + (2 + i) + ')').text().trim();
                console.log(i + ":" + val);
                $(ctl).parent().parent().children('td:nth-child(' + (2 + i) + ')').html('<input type="text" style="width:50px" value="' + val + '" />');
            }
        } else {
            var elem = $(ctl).parent().parent();

            data = {
                MaDT: id
                , Mau: $(elem).children('td:nth-child(1)').text()
                , SoLuong: $(elem).children('td:nth-child(2)').children().val()
                , DonGiaNhap: $(elem).children('td:nth-child(3)').children().val()
                , DonGiaBan: $(elem).children('td:nth-child(4)').children().val()
            }
            console.log(data);
            $.ajax({
                type: 'PUT'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                }
                , url: '/Group8_PhoneStore/update-price'
                , data: JSON.stringify(data)
                , contentType: 'application/json'
                , success: function(result) {
                    // console.log(result);
                    toastr.options = {
                        "timeOut": 3000 // 3s
                        , "progressBar": true
                    }
                    toastr.success(result);
                }
                , error: function(xhr, ajaxOptions, thrownError) {
                    toastr.options = {
                        "timeOut": 3000 // 3s
                        , "progressBar": true
                    }
                    toastr.error(JSON.parse(xhr.responseText));
                    // console.log(xhr.status);
                    // console.log(xhr.responseText);
                    // console.log(ajaxOptions);
                    // console.log(thrownError);
                }
            , }).done(function() {
                console.log('Edit done');
            }).fail(function(msg) {
                console.log('Edit FAIL');
                // toastr.options = {
                //     "timeOut": 3000 // 3s
                //     , "progressBar": true
                // }
                // toastr.error("Sửa thông tin thất bại");
            });

            for (var i = 0; i < 3; i++) {
                $(elem).children('td:nth-child(' + (2 + i) + ')').text($(ctl).parent().parent().children('td:nth-child(' + (2 + i) + ')').children('input').val());
            }
            $(ctl).text('Edit');
        }
    }

</script>
@endsection
