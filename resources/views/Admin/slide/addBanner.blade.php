@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid ">
    <div class="row">
        {{-- <div class="col-md-2"></div> --}}
        <div class="col-md-12">
            <!-- Horizontal Form -->
            @if (count($errors) > 0)
            <ul id="error_message" style="display:none">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Thêm mới ảnh cho banner</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ url('/insert-banner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="txtNoiDung" class="col-sm-2 col-form-label">Nội dung</label>
                            <div class="col-sm-10">
                                <textarea class="summernote" name="txtNoiDung" id="summernote">
                                {{ old('txtThongSo') }}

                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ddlType" class="col-sm-2 col-form-label">Trạng thái</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ddlType" id="">
                                    <option value="Slide Main Page">Slide Trang chủ</option>
                                    <option value="Top Banner">Top Banner</option>
                                    <option value="Mid Banner">Mid Banner</option>
                                    <option value="Bottom Banner">Bottom Banner</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" multiple class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
            {{-- <div class="col-md-2"></div> --}}
        </div>
        <!--/.col (left) -->
    </div>
</div>
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

</script>
@endsection
