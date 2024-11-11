<div class="col-lg-3">
    <ul class="account-nav">
      <li><a href="{{ route("client.qltaikhoan")}}" class="menu-link menu-link_us-s {{ request()->routeIs('client.qltaikhoan') ? "menu-link_active" : "" }}">Dashboard</a></li>
      <li><a href="{{ route("client.qldonhang")}}" class="menu-link menu-link_us-s {{ request()->routeIs('client.qldonhang') || request()->is('client/qlDonHang/*')   ? "menu-link_active" : "" }}">Orders</a></li>
      <li><a href="{{ route("client.qltaikhoanchitiet") }}" class="menu-link menu-link_us-s  {{ request()->routeIs('client.qltaikhoanchitiet') ? "menu-link_active" : "" }}">Account Details</a></li>
    </ul>
</div>