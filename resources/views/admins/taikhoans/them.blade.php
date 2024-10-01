@extends('layouts.admin')
@section("title")

@endsection
@section('head')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admins/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admins/dist/css/adminlte.min.css')}}">
@endsection
@section("content")
<div class="row">
    <!-- left column -->
     <div class="col-12">
        <form action="{{route("admin.taikhoan.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin sản phẩm</h3>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Họ và tên</label>
                                            <input type="text" class="form-control" id="name" name="ho_ten" placeholder="Nhập họ và tên">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Email</label>
                                            <input type="email" class="form-control" id="name" name="email" placeholder="Nhập email tài khoản">
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Mật khẩu</label>
                                            <input type="password" class="form-control" id="name" name="mat_khau" placeholder="Nhập họ và tên">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Xác nhận mật khẩu</label>
                                            <input type="password" class="form-control" id="name" name="xac_nhan_mk" placeholder="Nhập email tài khoản">
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Số điện thoại</label>
                                            <input type="text" class="form-control" id="name" name="so_dien_thoai" placeholder="Nhập họ và tên">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Địa chỉ</label>
                                            <input type="text" class="form-control" id="name" name="dia_chi" placeholder="Nhập email tài khoản">
                                        </div>
                                    </div>  
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Giới tính</label>
                                            <select class="custom-select rounded-0" id="product_type" name="gioi_tinh" style="width: 100%;">
                                                <option value=""></option>
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Ngày sinh</label>
                                            <input type="date" class="form-control" id="name" name="ngay_sinh" placeholder="Nhập email tài khoản">
                                        </div>
                                    </div>  
                                    
                            </div>
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chức vụ tài khoản</h3>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <option value="">Vui lòng chọn chức vụ</option>
                                        <select class="custom-select rounded-0" id="product_type" name="chuc_vu_id" style="width: 100%;">
                                            @foreach($chucvus as $chucvu)
                                            <option value="{{$chucvu->id}}">{{$chucvu->ten_chuc_vu}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </div>
                            </div>
                            
                        
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ảnh đại diện</h3>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <label class="" style="cursor: pointer; width: 200px; height: 200px;" for="avatar">
                                            <img style="width: 100%; height: 100%; object-fit: scale-down;" class="render_image" src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" alt="">
                                        </label>
                                        <input type="file"  id="avatar" name="anh_dai_dien" style="display: none;" onchange="handleCustomImage(event)">
                                    </div>
                                </div>
                               
                            </div>
                    </div>
                    
                </div>
        
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trạng thái</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="custom-select rounded-0" id="product_type" name="trang_thai" style="width: 100%;">
                                        <option value="">Trạng thái sản phẩm</option>
                                        <option value="0">Không kích hoạt</option>
                                        <option value="1">Kích hoạt</option>
                                    </select>
                                </div>
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
@section("scripts")
<script src="{{asset('admins/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admins/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
    function handleCustomImage(event){
            const file = event.target.files[0];
            const reader = new FileReader();
            if(reader){
                reader.onload = (event) => {
                    const img = document.querySelector('.render_image');
                    img.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
    }
</script>
@endsection