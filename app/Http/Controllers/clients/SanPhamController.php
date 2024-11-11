<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\GioHang;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\BinhLuan;
class SanPhamController extends Controller
{
     protected $giohang;
     protected $binhLuan;
     public function __construct(GioHang $giohang, BinhLuan $binhLuan)
     {
        $this->giohang = $giohang;
        $this->binhLuan = $binhLuan;
     }
    public function SanPhamChiTiet(Request $request, $id){
        $title = "Chi tiết sản phẩm";
        $sanPham = SanPham::query()->with("danhmucs")->find($id);
        $sanPham->luot_xem = ++$sanPham->luot_xem;
        $sanPham->save();
        $danhmucs = DanhMuc::query()->get();
        $binhluans = $this->binhLuan->getBinhLuanBySp($id);
        if (session()->exists('cart')) {
            $giohangs = session()->get('cart',[]);
        
        } else {
            if (Auth::check()) {
                // Nếu người dùng đã đăng nhập, lấy giỏ hàng từ cơ sở dữ liệu và lưu vào session
                $giohang = GioHang::query()
                            ->with("sanphams")
                            ->where('nguoi_dung_id', Auth::id())
                            ->get();
                session()->put('cart', $giohang);
                $giohangs = $giohang;
            } else {
                // Nếu người dùng chưa đăng nhập, tạo giỏ hàng trống
                session()->put('cart', []);
                $giohangs = [];
            }
        }
       
        $sanPhamlq = SanPham::query()->with("danhmucs")->where("danh_muc_id",$sanPham->danhmucs()->pluck("id")[0])->get();
       return view("clients.sanpham.sanphamchitiet",compact('title','sanPham','sanPhamlq','danhmucs','giohangs','binhluans'));

    }
    public function themSpGioHang(Request $request){
        $data = $request->all();
     
        $giohangs = GioHang::query()->where("nguoi_dung_id", Auth::id())->get();
        if ($giohangs) {
            foreach ($giohangs as $giohang) {
                if ($giohang->sanphams()->wherePivot('san_pham_id', $data['san_pham_id'])->first()) { 
                    $update = [
                        "id" => $giohang->id,
                        "so_luong" => $giohang->sanphams[0]->pivot->so_luong + $data["so_luong"],
                        "gia_san_pham" => $giohang->sanphams[0]->gia_san_pham
                    ];
                    if($giohang->sanphams[0]->so_luong < $update["so_luong"]){
                        return response()->json(["error" => "Số lượng đã quá giới hạn mức cho phép"]);
                    }
                    $giohang->sanphams()->updateExistingPivot($data["san_pham_id"], [
                        "so_luong" => $update["so_luong"]
                    ]);
                    $giohang->load('sanphams');
                    if (session()->exists('cart')) {
                        session()->put('cart', $giohangs);
                       
                    } else {
                        session()->put('cart', $giohangs);
                    }
                
                    return response()->json(["update" => $update]);
                   
                }
            }
           
        }
        
        $giohang = $this->giohang->themSpGioHang($data);
        $giohangs = GioHang::query()->where("nguoi_dung_id", Auth::id())->get();

        if (session()->exists('cart')) {
            session()->put('cart', $giohangs);
           
        } else {
            session()->put('cart', $giohangs);
        }
        $response = [];
        if($giohang){
            $sanpham = $giohang->sanphams[0];
            $response["id"] = $giohang->id;
            $response["so_luong"] = $sanpham->pivot->so_luong;
            $response["hinh_anh"] = asset('storage/uploads/sanphams/' .$sanpham->hinh_anh);
            $response["ten_san_pham"] = $sanpham->ten_san_pham;
            $response['gia_san_pham'] = $sanpham->gia_san_pham;
            $response["success"] = "Thêm sản phẩm thành công";
            return response()->json($response);    
        }
        else {
            return response()->json(["error"=> "Thêm giỏ hàng thất bại"]);    
        }
    }
    public function deleteGioHang($id){
        $giohang = GioHang::query()->find($id);
        $carts = session()->get('cart',[]);

        if($giohang){
            foreach($carts as $index => $cart){
                if($cart->id == $id){
                    unset($carts[$index]);
                    break;  
                }
            }
            session()->put('cart', $carts);
            
            $giohang->sanphams()->detach();
            $giohang->delete();
           
            return response()->json(["success"=> "Xóa giỏ hàng thành công"]);    
        }
        else {
            return response()->json(["error"=> "Xóa giỏ hàng không thành công"]);    
        }
    }

}
