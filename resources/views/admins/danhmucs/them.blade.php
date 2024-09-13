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

            <form action="{{ route('admin.danhmucs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thêm danh mục</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Hình ảnh</label>
                                            <input type="file" class="form-control" name="hinh_anh"
                                                onchange="showImage(event)">
                                        </div>
                                        <img id="image_danh_muc" src="" alt="Hình ảnh danh mục"
                                            style="width: 200px; display: none">
                                        <div class="form-group">
                                            <label for="name">Tên danh mục</label>
                                            <input type="text"
                                                class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                                name="ten_danh_muc" placeholder="Nhập tên sản phẩm" value="{{old('ten_danh_muc')}}">
                                            @error('ten_danh_muc')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Mô tả sản phẩm</label>
                                            <textarea class="form-control" name="mo_ta" rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
                                </div>
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
