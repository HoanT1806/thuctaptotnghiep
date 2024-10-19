@extends('layouts.admin')
@section("title")
{{$title}}
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
        {{-- {{$donHang}} --}}
        <form action="{{route('donhang.update',$donHang->trang_thai_id)}}" method="POST">
            @csrf
            @method('PUT')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin đơn hàng</h3>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Trạng thái đơn hàng</label>
                                        {{-- <input type="text" class="form-control" name="ten_phuong_thuc" placeholder="Nhập tên phương thức thanh toán " value="{{$dsPttt->ten_phuong_thuc}}"> --}}
                                        <br>
                                        <select name="trang_thai_id" class="form-select">
                                            <option selected>Trạng thái của đơn hàng   </option>
                                            <option value="1" {{ $donHang->trang_thai_id == '1' ? 'selected' : '' }}>Chờ xác nhận </option>
                                            <option value="2" {{ $donHang->trang_thai_id == '2' ? 'selected' : '' }}>Đã xác nhận</option>
                                            <option value="3" {{ $donHang->trang_thai_id == '3' ? 'selected' : '' }}>Đang giao hàng</option>
                                            <option value="4" {{ $donHang->trang_thai_id == '4' ? 'selected' : '' }}>Giao hàng thành công</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-warning">Cập nhật</button>
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