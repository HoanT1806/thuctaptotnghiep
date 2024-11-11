@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('style')
    <style>
        main {

            padding-top: 90px !important;
        }
    </style>
@endsection
@section('content')
<div class="mb-4 pb-4"></div>
<section class="shop-checkout container">
  <h2 class="page-title">Cart</h2>
  @csrf
  <div class="checkout-steps">
    <a href="shop_cart.html" class="checkout-steps__item active">
      <span class="checkout-steps__item-number">01</span>
      <span class="checkout-steps__item-title">
        <span>Shopping Bag</span>
        <em>Manage Your Items List</em>
      </span>
    </a>
    <a href="shop_checkout.html" class="checkout-steps__item">
      <span class="checkout-steps__item-number">02</span>
      <span class="checkout-steps__item-title">
        <span>Shipping and Checkout</span>
        <em>Checkout Your Items List</em>
      </span>
    </a>
    <a href="shop_order_complete.html" class="checkout-steps__item">
      <span class="checkout-steps__item-number">03</span>
      <span class="checkout-steps__item-title">
        <span>Confirmation</span>
        <em>Review And Submit Your Order</em>
      </span>
    </a>
  </div>
  <div class="shopping-cart">
    <div class="cart-table__wrapper">
      <table class="cart-table">
        <thead>
          <tr>
            <th>Product</th>
            <th></th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
            @foreach($giohangs as $giohang)
          <tr class="cart_list-{{$giohang->id}} cart_list" >
            <td>
              <div class="shopping-cart__product-item">
                <a href="product1_simple.html">
                  <img loading="lazy" src="{{asset('storage/uploads/sanphams/'. $giohang->sanphams->pluck('hinh_anh')[0])}}" width="120" height="120" alt="">
                </a>
              </div>
            </td>
            <td>
              <div class="shopping-cart__product-item__detail">
                <h4><a href="product1_simple.html">{{$giohang->sanphams->pluck('ten_san_pham')[0] }}</a></h4>
                <ul class="shopping-cart__product-item__options">
                  <li>Danh mục : {{$giohang->sanphams[0]->danhmucs->ten_danh_muc}} </li>
                
                </ul>
              </div>
            </td>
            <td>
              <span data-subtotal="{{$giohang->sanphams[0]->gia_san_pham}}" class="shopping-cart__product-price">{{ number_format($giohang->sanphams[0]->gia_san_pham,0,".",".")}} &#8363;</span>
            </td>
            <td>
              <div class="qty-control position-relative">
                <input type="number" data-id={{ $giohang->id}} name="quantity" value="{{ $giohang->sanphams[0]->pivot->so_luong}}" min="1" class="qty-control__number text-center">
                <div class="qty-control__reduce">-</div>
                <div class="qty-control__increase">+</div>
              </div><!-- .qty-control -->
            </td>
            <td>
              <span data-subtotal="{{$giohang->sanphams[0]->gia_san_pham  * $giohang->sanphams[0]->pivot->so_luong}}" class="shopping-cart__subtotal">{{ number_format($giohang->sanphams[0]->gia_san_pham  * $giohang->sanphams[0]->pivot->so_luong ,0,".",".")}} &#8363;</span>
            </td>
            <td>
              <a href="#" class="remove-cart" data-index="{{ $giohang->id}}">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z"/>
                  <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z"/>
                </svg>                  
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="cart-table-footer">
        <form action=""  class="position-relative bg-body form-coupon">
          <input class="form-control" type="text" name="ma_giam_gia" placeholder="Coupon Code">
          <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="APPLY COUPON">
        </form>
        <button class="btn btn-light">UPDATE CART</button>
      </div>
    </div>
    <form class="shopping-cart__totals-wrapper"  >
      <div class="sticky-content">
        <div class="shopping-cart__totals">
          <h3>Cart Totals</h3>
          <table class="cart-totals">
            <tbody>
              <tr>
                <th>Subtotal</th>
                <td data-price="{{$subtotal}}" class="cart_subtotal">{{number_format($subtotal,0,".",".")}} &#8363;</td>
              </tr>
              <tr>
                <th>Shipping</th>
                <td>
                  <div class="form-check">
                    <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="free_shipping">
                    <label class="form-check-label" for="free_shipping">Free shipping</label>
                  </div>
                  
                </td>
              </tr>
              @session('coupon')
              <tr   class="coupon_detail-name">
                <th>Mã giảm giá</th>
                <td>
                  {{ $ten_ma_giam_gia }}
                </td>       
              </tr>
              <tr class="coupon-price">
                <th></th>
                <td>
                    - {{ number_format($duocgiam,0,".",".")}}
                </td>
              <tr>
              @endsession
             
             
            
              <tr style="display:none"  class="coupon_detail-name">
                <th>Mã giảm giá</th>
                <td>
                    Tên mã giảm giá
                </td>
              </tr>
              <tr style="display:none" class="coupon-price">
                <th></th>
                <td>
                    -200.000 đ
                </td>
              <tr>
             
              <tr>
                <th>Total</th>
                <td data-price="{{$total}}" class="cart_total">{{number_format($total,0,".",".")}} &#8363;</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mobile_fixed-btn_wrapper">
          <div class="button-wrapper container">
            <a href="{{ route('client.cartcheckout')}}" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection
@section('scripts')
  <script>
    const formCoupon = document.querySelector(".form-coupon")
    console.log(formCoupon);
    formCoupon.onsubmit = function(){
      event.preventDefault();
      const maGiamGia = this.querySelector("input[name='ma_giam_gia']");
      const url =  `${location.origin}/client/magiamgia?ma_giam_gia=${maGiamGia.value}`;
      $.ajax({
        url : url,
        method :"GET",
        success : function(res){
          if(res.success){
            const subtotal = document.querySelector(".cart_subtotal");
            const total = document.querySelector(".cart_total");
        
            const coupon_name = document.querySelector(".coupon_detail-name");
            const coupon_price = document.querySelector(".coupon-price")
            const giamgia = res.ma_giam_gia;
            if(giamgia.dieu_kien ==1){
              const giam_gia = ( (100-parseInt(giamgia.giam_gia)) / 100) * parseInt(subtotal.dataset.price) ;
              const duoctru = parseInt(subtotal.dataset.price) * ( parseInt(giamgia.giam_gia) / 100)
              total.innerHTML = formatCurrency(giam_gia);
              coupon_name.style.display = 'table-row';
              coupon_price.style.display = 'table-row';
              coupon_name.querySelector("td").innerHTML = giamgia.ten_ma_giam_gia;
              coupon_price.querySelector("td").innerHTML =  "- "+formatCurrency(duoctru);
            }
            else {

            }
          }
        }
      })
    }
    function formatCurrency(amountInVND) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amountInVND);
            }
  </script>
@endsection
