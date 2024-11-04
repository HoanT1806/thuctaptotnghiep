<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BinhLuan extends Model
{
    use HasFactory;

    protected $table = "tb_binh_luan";
    protected $fillable = [
        'tai_khoan_id',
        'san_pham_id', 
        'noi_dung',
        'thoi_gian',
        'trang_thai',
       ];
    public function getBinhLuanBySp($id){
        return 
        DB::table("tb_binh_luan")
        ->join("tb_tai_khoan","tb_binh_luan.tai_khoan_id","=","tb_tai_khoan.id")
        ->join("tb_san_pham","tb_binh_luan.san_pham_id","=","tb_san_pham.id")
        ->select(["tb_tai_khoan.ho_ten as ho_ten","tb_tai_khoan.anh_dai_dien as anh_dai_dien","tb_binh_luan.noi_dung as noi_dung","tb_binh_luan.thoi_gian as ngay_dang"])
        ->where("tb_binh_luan.san_pham_id","=",$id)
        ->where("tb_binh_luan.trang_thai","=" ,1)
        ->get();
        ;
    }

}
