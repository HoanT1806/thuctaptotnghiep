<?php


use App\Http\Controllers\admins\DonHangController;
use App\Http\Controllers\admins\PtttController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\admins\SanPhamController;
use App\Http\Controllers\admins\ChucVuController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\admins\TaiKhoanController;
use App\Http\Controllers\admins\AdminController;

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\clients\SanPhamController as ClientSanPham;
use App\Http\Controllers\clients\GioHangController;
use App\Http\Controllers\clients\DonHangController as  ClientDonHang;
use App\Http\Controllers\clients\BinhLuanController as clientBinhLuan;
use App\Http\Controllers\admins\BinhLuanController;
use App\Http\Controllers\clients\TaiKhoanController as clientTaiKhoan;
use App\Http\Controllers\clients\PaymentController;


Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::middleware(['auth',CheckRoleAdminMiddleware::class])->prefix("admin")->name("admin.")->group(function () {
    Route::resource("sanpham", SanPhamController::class);
    Route::resource("taikhoan", taikhoanController::class);
    Route::resource('pttt', PtttController::class);
    Route::resource('donhang', DonHangController::class);
    Route::resource("chucvus", ChucvuController::class); 
    Route::resource('danhmucs', DanhMucController::class);
    Route::resource('binhluan',BinhLuanController::class);
});
Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
//admin
Route::get("/",function(){
    return redirect()->route("client.index");
});

Route::get('/adminhome', [AdminController::class, 'index'])->name('adminhome');
Route::prefix('/')->name("client.")->group(function(){
   Route::get("/trang-chu",[HomeController::class,"index"])->name("index");
   Route::get("/san-pham-chi-tiet/{id}",[ClientSanPham::class,"sanphamchitiet"])->name("sanphamchitiet");   
   Route::get("/client/logout",[HomeController::class,"logout"])->name("logout");
   Route::get("/client/cart",[GioHangController::class,"index"])->name("cart");
   Route::post("/client/cart-vocher",[GioHangController::class,"index"])->name("cartvocher");       
   Route::get("/client/cart/checkout",[GioHangController::class,"checkout"])->name("cartcheckout");
   Route::post("/client/cart/muahang",[ClientDonHang::class,"muahang"])->name("cartmuahang");
   Route::get("/client/donhang/{id}/thanhcong",[ClientDonHang::class,"muahangthanhcong"])->name("muahangthanhcong");
   Route::post("/client/thembinhluan",[clientBinhLuan::class,'store']);
   Route::get("/client/taikhoan/dashboard",[clientTaiKhoan::class,"index"])->name("qltaikhoan");
   Route::get("/client/taikhoan/chitiet",[clientTaiKhoan::class,"chitiet"])->name("qltaikhoanchitiet");
   Route::get("/client/qlDonHang/",[ClientDonHang::class,"qldonhang"])->name("qldonhang");
   Route::get("/client/qlDonHang/{id}",[ClientDonHang::class,"donhangchitiet"])->name("donhangchitiet");
   Route::get("/client/danh-muc/{id}",[HomeController::class,"getspbyid"])->name("danhmucsanpham");
   Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');
   Route::get("/client/magiamgia",[GioHangController::class,"checkCoupon"])->name("magiamgia");

});
Route::post("/client/login",[HomeController::class,"login"])->name("client.login");
Route::post("/client/register",[HomeController::class,"register"])->name("client.register");
Route::post('/client/addCat',[ClientSanPham::class,"themSpGioHang"])->name("client.addCat");    
Route::delete("/client/cart/delete/{id}",[ClientSanPham::class,"deleteGioHang"])->name("client.deletecart");
Route::put("/client/cart/update/{id}",[GioHangController::class,"updateGioHang"])->name("client.updatecart");

Route::post("/vnpay_payment",[PaymentController::class,'vnpay_payment']);
Route::post("/momo_payment",[PaymentController::class,'momo_payment']);
