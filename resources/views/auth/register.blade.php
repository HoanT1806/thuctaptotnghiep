@extends('layouts.auth')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="card-body register-card-body">
    <p class="login-box-msg">Đăng ký tài khoản mới</p>

    <form action="{{route('register')}}" method="post">
        @csrf
      <div class="input-group mb-3">
        <input type="text" class="form-control  @error('ho_ten') is-invalid @enderror" placeholder="Họ Và Tên" name="ho_ten">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>
      @error('ho_ten')
       <p class="text-danger">{{$message}}</p>   
      @enderror
      <div class="input-group mb-3">
        <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      @error('email')
      <p class="text-danger">{{$message}}</p>  
  @enderror
      <div class="input-group mb-3">
        <input type="password" class="form-control  @error('mat_khau') is-invalid @enderror" placeholder="Mật khẩu" name="mat_khau">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      @error('mat_khau')
      <p class="text-danger">{{$message}}</p>  
  @enderror
      {{-- <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Retype password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div> --}}
      <div class="row d-flex justify-content-center">
        {{-- <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
            <label for="agreeTerms">
             I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div> --}}
        <!-- /.col -->
        <div class="col-5">
          <button type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- Hoặc -</p>
      <a href="#" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i>
        Đăng nhập bằng Facebook
      </a>
      <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-google-plus mr-2"></i>
        Đăng nhập bằng Google+
      </a>
    </div>

    <a href="{{route('login')}}" class="text-center">Đã có tài khoản đăng nhập ngay</a>
  </div>
@endsection