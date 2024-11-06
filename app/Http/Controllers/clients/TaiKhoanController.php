<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\GioHang;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class TaiKhoanController extends Controller
{
    public $data = [];
    public function __construct()
    {
        $this->data["danhmucs"] = DanhMuc::query()->get();
       
    }
    public function index()
    {
        if (session()->exists('cart')) {
            $this->data["giohangs"] = session()->get('cart', []);
        } else {
            if (Auth::check()) {
                // Nếu người dùng đã đăng nhập, lấy giỏ hàng từ cơ sở dữ liệu và lưu vào session
                $giohang = GioHang::query()
                    ->with("sanphams")
                    ->where('nguoi_dung_id', Auth::id())
                    ->get();
                session()->put('cart', $giohang);
                $this->data["giohangs"] = $giohang;
            } else {
                // Nếu người dùng chưa đăng nhập, tạo giỏ hàng trống
                session()->put('cart', []);
                $this->data["giohangs"] = [];
            
            }
        }
        $title = "QUẢN LÝ TÀI KHOẢN";
        $data = $this->data;
        $data["title"] = $title;
        
        return view("clients.taikhoans.dasboard", $data);
    }
    public function chitiet(){
        if(Auth::check()){
            if (session()->exists('cart')) {
                $this->data["giohangs"] = session()->get('cart', []);
            } else {
                if (Auth::check()) {
                    // Nếu người dùng đã đăng nhập, lấy giỏ hàng từ cơ sở dữ liệu và lưu vào session
                    $giohang = GioHang::query()
                        ->with("sanphams")
                        ->where('nguoi_dung_id', Auth::id())
                        ->get();
                    session()->put('cart', $giohang);
                    $this->data["giohangs"] = $giohang;
                } else {
                    // Nếu người dùng chưa đăng nhập, tạo giỏ hàng trống
                    session()->put('cart', []);
                    $this->data["giohangs"] = [];
                
                }
            }
            $title = "Tài khoản";
            $data = $this->data;
            $data["title"] = $title;
            $data["taikhoan"] = Auth::user();
            return view("clients.taikhoans.taikhoan", $data);
        }
        
    }
}
