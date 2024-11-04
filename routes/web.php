<?php


use App\Http\Controllers\admins\DonHangController;
use App\Http\Controllers\admins\PtttController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\DanhMucController;
use App\Http\Controllers\admins\SanPhamController;
use App\Http\Controllers\admins\ChucVuController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\admins\TaiKhoanController;
use App\Http\Controllers\Admins\AdminController;

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
