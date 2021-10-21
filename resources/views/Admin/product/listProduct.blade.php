@section('css')
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

<!-- Main content -->
@extends('layouts.admin_layout')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Danh sách sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã ĐT</th>
                                    <th>Tên ĐT</th>
                                    <th>Nhà sản xuất</th>
                                    <th>Ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $item)
                                <tr>
                                    <td>{{ $item-> MaDT}}</td>
                                    <td>{{ $item-> TenDT}}</td>
                                    <td>{{ $item->supplier->TenNSX}}</td>
                                    <td>
                                        @foreach ($item->image as $image)
                                        <img src="{{ asset('public/backend/uploads/product-images/'.$image->Anh)}}" style="width: 50px; height: 50px" alt="">
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($item-> TrangThai)
                                        <button class="btn btn-success disabled">
                                            <i class="fas fa-check-circle"></i>
                                            Available
                                        </button>
                                        @elseif (!$item->TrangThai)
                                        <button class="btn btn-danger btn-block disabled">
                                            <i class="fas fa-check-circle"></i>
                                            Disabled
                                        </button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('edit-product/'.$item->MaDT) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="{{ url('delete-product/'.$item->MaDT)}}" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này ?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                        <a href="{{ url('product-quantity/'.$item->MaDT)}}" class="btn btn-success"><i class="fas fa-warehouse"></i></i> Storage</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<!-- /.content -->
@endsection

@section('js')
<!-- Page specific script -->
<script src=" {{asset('public/backend/Admin/Layout/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $("#example1").DataTable({
            "columnDefs": [{
                "width": "10%"
                , "targets": [0, 2, 4]
            }, {
                "width": "20%"
                , "targets": 1
            }, {
                "width": "25%"
                , "targets": 3
            }, {
                "width": "25%"
                , "targets": 5
                , "className": "text-center"
            }]
            , "responsive": true
                // , "lengthChange": false
            , "pageLength": 2
            , "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    // alert('ok');
    @if(session('status'))
    // toastr.options.timeOut = 3000;
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.success("{{ session('status') }}");
    @endif

    @if(session('error'))
    // toastr.options.timeOut = 3000;
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

</script>

@endsection
