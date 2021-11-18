@section('css')
<link rel="stylesheet"
    href="{{asset('public/backend/Admin/Layout/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet"
    href="{{asset('public/backend/Admin/Layout/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

<!-- Main content -->
@extends('layouts.admin_layout')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title mr-2 flex-grow-1">Danh sách người dùng</h3>
                        <a href="{{ route('customers.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Thêm mới</a>
                    </div>

                    {{-- @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    {{-- <th>Password</th>
                                    <th>Remember token</th> --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer-> id}}</td>
                                    <td>{{ $customer-> email}}</td>
                                    <td>{{ $customer-> name}}</td>
                                    <td>{{ $customer-> phone}}</td>
                                    {{-- <td>{{ $customer-> password}}</td>
                                    <td>{{ $customer-> remember_token}}</td> --}}
                                    <td class="d-flex">
                                        <a href="{{ route('customers.edit' ,['customer' => $customer->id] )}}"
                                            class="btn btn-primary m-2"><i class="fas fa-edit"></i></a>
                                        @if($customer->status == 1)
                                        <a href="{{ route('customers.status.update', ['customer_id' => $customer->id, 'status_code' => 0]) }}"
                                            class="btn  btn-danger m-2">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('customers.status.update', ['customer_id' => $customer->id, 'status_code' => 1]) }}"
                                            class="btn btn-success m-2">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        @endif
                                      @if($customer->status == -1)
                                        <a href="{{ route('customers.status.update', ['customer_id' => $customer->id, 'status_code' => 1]) }}"
                                            class="btn  btn-danger m-2">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('customers.status.update', ['customer_id' => $customer->id, 'status_code' => -1]) }}"
                                            class="btn btn-secondary m-2">

                                            <i class="fa fa-user-slash" aria-hidden="true"></i>
                                        </a>
                                        @endif

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
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}">
</script>
<script src="{{asset('public/backend/Admin/Layout/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}">
</script>
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
                , "targets": [0, 1, 5]
            }, {
                "width": "20%"
                , "targets": 2
            }, {
                "width": "15%"
                , "targets": [3, 4]
            }, {
                "width": "10%"
                , "targets": 6
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
    toastr.options = {
        "timeOut": 3000 // 3s
        , "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

    $('a.deletConfirm').click(function() {
        // prompt('bạn có chắc muốn xóa nhà sản xuất này?');
        alert('ok');
        console.log($(this));
    });

</script>

@endsection
