@extends('layouts.admin')
@section('title')
@endsection
@section('head')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admins/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admins/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-12">

            <form action="{{ route('admin.binhluan.update', $binhluan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa bình luận</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="trang_thai">Chỉnh sửa trạng thái bình luận</label>
                                    <select name="trang_thai" id="trang_thai" class="form-control">
                                        <option value="">--Chọn trạng thái--</option>
                                        <option value="1">Hiển thị</option>
                                        <option value="2">Ẩn</option>
                                    </select>
                                    @if ($errors->has('trang_thai'))
                                        <span class="text-danger">{{ $errors->first('trang_thai') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row d-flex justify-content-center">
                                <button type="submit" class="btn btn-warning">Sửa</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('admins/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admins/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- Page specific script -->
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        function showImage(event) {
            const image_danh_muc = document.getElementById('image_danh_muc');

            const file = event.target.files[0];

            const reader = new FileReader();

            reader.onload = function() {
                image_danh_muc.src = reader.result;
                image_danh_muc.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
