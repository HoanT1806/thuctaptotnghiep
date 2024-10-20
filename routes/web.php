<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admins\ChucVuController;
use App\Http\Controllers\admins\DanhMucController;
use App\Http\Controllers\admins\SanPhamController;
use App\Http\Controllers\admins\TaiKhoanController;
use App\Http\Controllers\admins\DonHangController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('danhmucs', DanhMucController::class);
    Route::resource("sanpham", SanPhamController::class);
    Route::resource("chucvus", ChucVuController::class);
    Route::resource("taikhoan", taikhoanController::class);
    Route::resource('donhang', DonHangController::class);
});
