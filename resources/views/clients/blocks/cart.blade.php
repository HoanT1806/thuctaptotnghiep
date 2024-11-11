<div class="aside aside_right overflow-hidden cart-drawer" id="cartDrawer">
    <div class="aside-header d-flex align-items-center">
      <h3 class="text-uppercase fs-6 mb-0">SHOPPING BAG ( <span class="cart-amount js-cart-items-count">{{count($giohangs)}}</span> ) </h3>
      <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
    </div><!-- /.aside-header -->
    {{-- @if(Auth::check()) --}}
    <div class="aside-content cart-drawer-items-list">
      @if(count($giohangs) > 0)
      @foreach($giohangs as $giohang)
      <div class="cart-drawer-item d-flex position-relative" data-index="{{$giohang->id}}">
        <div class="position-relative">
          <a href="product1_simple.html">
            <img loading="lazy" class="cart-drawer-item__img" src="{{asset('storage/uploads/sanphams/'. $giohang->sanphams[0]->hinh_anh)}}" alt="">
          </a>
        </div>  
        <div class="cart-drawer-item__info flex-grow-1">
          <h6 class="cart-drawer-item__title fw-normal"><a href="product1_simple.html">{{$giohang->sanphams[0]->ten_san_pham}}</a></h6>
          <div class="d-flex align-items-center justify-content-between mt-1">
            <div class="qty-control position-relative">
              <input type="number" name="so_luong" value="{{$giohang->sanphams[0]->pivot->so_luong}}" min="1" class="qty-control__number border-0 text-center">
              <div class="qty-control__reduce text-start">-</div>
              <div class="qty-control__increase text-end">+</div>
            </div><!-- .qty-control -->
            <span data-price="{{$giohang->sanphams[0]->gia_san_pham}}" class="cart-drawer-item__price money price">{{number_format($giohang->sanphams[0]->gia_san_pham,"0",".",".")}} &#8363;</span>
          </div>
        </div>

        <button class="btn-close-xs position-absolute top-0 end-0 js-cart-item-remove" data-index="{{$giohang->id}}">
          @csrf
        </button>
      </div><!-- /.cart-drawer-item d-flex -->
      <hr class="cart-drawer-divider">

      @endforeach
      @endif
    </div><!-- /.aside-content -->
    <div class="cart-drawer-actions position-absolute start-0 bottom-0 w-100">
      <hr class="cart-drawer-divider">
      <div class="d-flex justify-content-between">
        <h6 class="fs-base fw-medium">SUBTOTAL:</h6>
       @php
       $total = 0;
           foreach ($giohangs as $key => $giohang) {
            $sanphams = $giohang->sanphams;
            foreach ($sanphams as $sanpham) {
              $total += $sanpham->pivot->so_luong * $sanpham->gia_san_pham;
            }
           }
       @endphp
       <style>
        .btn-full-width {
          display: block;
          width: 100%;
        }
      </style>
        <span class="cart-subtotal fw-medium"> {{ number_format($total,"0",".",".")}} đ</span>
      </div>
      <a href="{{ route('client.cart')}}" class="btn btn-light mt-3 btn-full-width">Đến giỏ hàng</a>

      <form action="{{url('/vnpay_payment')}}" method="POST">
        @csrf
        <button type="submit" name="redirect" class="btn btn-light mt-3 btn-full-width">Thanh toán bằng VNpay</button>
      </form>
      
      <form action="{{url('/momo_payment')}}" method="POST">
        @csrf
        <button type="submit" name="payUrl" class="btn btn-light mt-3 btn-full-width">Thanh toán bằng MoMo</button>
      </form>
      

    </div>
  </div>