@extends('layouts.admin')
@section("title")
    {{ $title}}
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
        <form action="{{route("admin.sanpham.update",$data->id)}}" method="POST" enctype="multipart/form-data">
            @method("PUT")
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
                                            <label for="name">Tên sản phẩm</label>
                                            <input type="text" class="form-control" id="name" name="ten_san_pham" value=" {{ old("ten_san_pham") ?? $data->ten_san_pham }} " placeholder="Nhập tên sản phẩm">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Mã sản phẩm</label>
                                            <input type="text" class="form-control" id="name" name="ma_san_pham" value="{{ $data->ma_san_pham }}" placeholder="Nhập tên sản phẩm">
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label for="description">Mô tả sản phẩm</label>
                                        <textarea class="form-control" id="description" name="mo_ta" rows="3" value="" placeholder="Nhập mô tả sản phẩm"> {{ old("mo_ta") ?? $data->mo_ta }} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá sản phẩm</label>
                                        <input type="number" class="form-control" id="price" name="gia_san_pham" value="{{ old("gia_san_pham") ?? (int) $data->gia_san_pham }}" placeholder="Nhập giá sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá khuyến mãi</label>
                                        <input type="number" class="form-control" id="price" name="gia_khuyen_mai" value="{{ old("gia_khuyen_mai") ?? (int) $data->gia_khuyen_mai }}" placeholder="Nhập giá khuyến mãi sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Số lượng</label>
                                        <input type="number" class="form-control" id="price" name="so_luong" value="{{ old("so_luong") ?? (int)$data->so_luong }}" placeholder="Nhập số lượng">
                                    </div>   
                                    <div class="form-group">
                                        <label for="price">Ngày nhập</label>
                                        <input type="date" class="form-control" id="price" name="ngay_nhap" value="{{ old("ngay_nhap") ?? $data->ngay_nhap }}" placeholder="Nhập số lượng">
                                    </div>  
                                    <div class="form-group">
                                        <label for="price">Lượt xem</label>
                                        <input type="number" class="form-control" id="price" name="luot_xem" value="{{ old("luot_xem") ?? (int)$data->luot_xem }}" placeholder="Nhập lượt xem">
                                    </div>  
                                    <div class="form-group">
                                        <label for="">Ảnh giới thiệu</label>
                                        <input type="file" multiple class="form-control" id="price" name="nhieu_anh[]" placeholder="">  
                                    </div>        
                            </div>
                        
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục sản phẩm</h3>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <option value="">Vui lòng chọn danh mục</option>
                                        <select class="custom-select rounded-0" id="product_type" name="danh_muc_id" style="width: 100%;">
                                            @foreach($danhmucs as $danhmuc)
                                            <option {{ $data->danh_muc_id == $danhmuc->id ? "selected" : "" }} value="{{$danhmuc->id}}">{{$danhmuc->ten_danh_muc}}</option>
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

                                            <img style="width: 100%; height: 100%; object-fit: scale-down;" class="render_image" src="{{  $data->hinh_anh ? asset("storage/uploads/sanphams/". "$data->hinh_anh" ) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg' }}" alt="">

                                        </label>
                                        <input type="file"  id="avatar" name="hinh_anh" style="display: none;" onchange="handleCustomImage(event)">
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
                                        <option {{ $data->trangthai ? "" : "selected" }} value="0">Không kích hoạt</option>
                                        <option {{ $data->trangthai ? "selected" :  "" }} value="1">Kích hoạt</option>
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