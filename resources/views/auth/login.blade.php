@extends('layouts.auth')
@section('title')
    {{$title}}
@endsection
@section('content')
<div class="card-body login-card-body">
  <p class="login-box-msg">Đăng nhập</p>
  @error('login')
  <p class="text-danger">{{ $message }}</p>
@enderror
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
  <form action="{{ route('login') }}" method="post">
    @csrf
      <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              placeholder="Email" value="{{ old('email') }}" autocomplete="email">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
              </div>
          </div>
      </div>
      @error('email')
          <p class="text-danger">{{ $message }}</p>
      @enderror
      <div class="input-group mb-3">
          <input type="password" class="form-control   @error('mat_khau') is-invalid @enderror" name="mat_khau" placeholder="Mật khẩu">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
          </div>
      </div>
      @error('mat_khau')
      <p class="text-danger">{{ $message }}</p>
  @enderror
      <div class="row d-flex justify-content-center">
          {{-- <div class="col-8">
              <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                      Remember Me
                  </label>
              </div>
          </div> --}}
          <!-- /.col -->
          <div class="col-5">
              <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
      </div>
  </form>

  <div class="social-auth-links text-center mb-3">
      <p>- Hoặc -</p>
      <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Đăng nhập bằng Facebook
      </a>
      <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Đăng nhập bằng Google+
      </a>
  </div>
  <!-- /.social-auth-links -->

  <p class="mb-1">
      <a href="forgot-password.html">Quên mật khẩu</a>
  </p>
  <p class="mb-0">
      {{-- <a href="{{ route('register') }}" class="text-center">Đăng ký tài khoản mới </a> --}}
  </p>
</div>
@endsection