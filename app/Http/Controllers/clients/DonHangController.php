<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\GioHang;
use App\Models\DonHang;
use App\Http\Requests\Clients\MuaHangRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\XacNhanDonHangMail;
use Illuminate\Support\Facades\DB;
class DonHangController extends Controller
{
    public function qldonhang(){
        if(Auth::check()){
            $title = "Đơn hàng";
            $danhmucs = DanhMuc::query()->get();
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
            $donhang = DonHang::query()->with(["sanphams","pttt","trangthai"])->where("nguoi_dung_id",Auth::id())->get();             
            return view("clients.taikhoans.donhang",compact("donhang","danhmucs",'giohangs','title'));
          
          }
    }
   public function muahang(MuaHangRequest $request){
      if(Auth::check()){
         $data = $request->except("_token");
         $data["nguoi_dung_id"] = Auth::id();
     
         $data["ngay_dat"] = date("Y-m-d",time());
         $data["trang_thai_id"] = "1";
         $carts = session()->get('cart',[])->toArray();
         foreach(session()->get('cart',[]) as $cart){
            $cart->sanphams[0]->so_luong =  $cart->sanphams[0]->so_luong - $cart->sanphams[0]->pivot->so_luong;
            $cart->sanphams[0]->save();
         }
         if(count($carts) > 0){
            $donhang = DonHang::query()->create($data);
            if(session()->exists("coupon")){
                $coupon = session()->get("coupon");
                $coupon = DB::table("tb_giam_gia")->where("ma_giam_gia",$coupon)->first();
                 DB::table("tb_giam_gia")->where("ma_giam_gia",$coupon->ma_giam_gia)->update([
                    "so_luong" => $coupon->so_luong - 1,
                ]);
                session()->forget("coupon");
                session()->save();
            }

            $donhang->ma_don_hang = time() + $donhang->id;
            $donhang->save();
             $pivot = array_map(function($cart) use ($donhang){
                  return [
                      "so_luong" => $cart['sanphams'][0]["pivot"]["so_luong"],
                      "don_hang_id" => $donhang->id,
                      "san_pham_id" => $cart['sanphams'][0]["id"],
                      "thanh_tien" => $cart['sanphams'][0]["pivot"]["so_luong"] * $cart['sanphams'][0]["gia_san_pham"],
                      "gia" => $cart['sanphams'][0]["gia_san_pham"],  
                  ];
             }, $carts);
            $donhang->sanphams()->sync($pivot);
          
            return redirect()->route("client.muahangthanhcong",$donhang->id);
             
         }
      }
    


   }
   public function muahangthanhcong($id){
    if(Auth::check()){
      $danhmucs = DanhMuc::query()->get();
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
      $donhang = DonHang::query()->with(["sanphams","pttt"])->findOrFail($id);
      if($donhang && $donhang->nguoi_dung_id == Auth::id()){
         $sanphams = $donhang->sanphams;
         $pttt = $donhang->pttt;
         Mail::to($donhang->email_nguoi_nhan)->send(new XacNhanDonHangMail($donhang,$pttt,$sanphams));
         return view("clients.carts.thanhcong",compact("donhang","danhmucs",'giohangs','pttt','sanphams'));
      }
    
    }
      
   }
   public function donhangchitiet($id){

       if(Auth::check()){
        $title = "Đơn hàng";
            $danhmucs = DanhMuc::query()->get();
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
            $donhang = DonHang::query()->with(["sanphams","pttt","trangthai"])->find($id);    
           
            return view("clients.taikhoans.donhangchitiet   ",compact("donhang","danhmucs",'giohangs','title'));
          
          }
   }
   
}
