<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\DanhMuc;
class SanPham extends Model
{   
    
    use HasFactory ;
    protected $danhmuc;
    public function __construct()
    {
        $this->danhmuc = new DanhMuc();
    }
    protected $fillable = [
        'ten_san_pham',
         'mo_ta',
         'hinh_anh',
         'so_luong',
         'gia_san_pham',
         'gia_khuyen_mai',
         'ngay_nhap',
         'danh_muc_id',
         'trang_thai'
          ];
    protected $table = "tb_san_pham";
    public function getAllSanPham(){
        $data = self::query()->with("danhmucs")->get()->toArray();
        $data = array_map(function($item){
            return [
                "id" => $item["id"],
                "ten_san_pham" => $item['ten_san_pham'],
                "mo_ta" => $item["mo_ta"],
                "hinh_anh" => $item["hinh_anh"],
                "so_luong" => $item["so_luong"],
                "gia_san_pham" => $item["gia_san_pham"],
                "gia_khuyen_mai" => $item["gia_khuyen_mai"],
                "ngay_nhap" => $item["ngay_nhap"],
                "ten_danh_muc" => $item["danhmucs"]["ten_danh_muc"],
                "trang_thai" => $item["trang_thai"],
                
             ];
        },$data);
        return $data;
    }
    public function getSanPhamId($id){
        return self::query()->with("danhmucs")->where("id",$id)->first();
    }
    public function getDanhMungbySanPham($id){
        return $this->danhmuc->getDanhMucId($id);
    }
    public function getAllDanhMuc(){
        return $this->danhmuc->getAllDanhMuc();
    }
     public function danhmucs(){
        return $this->belongsTo(DanhMuc::class,"danh_muc_id");
     }
     public function themSanPham($data){
        return self::query()->create($data);
     }
     public function suaSanPhamm($data,$id){
        return self::query()->where("id",$id)->update($data);
     }
     public function xoaSanPham($id){
        return self::query()->where("id",$id)->delete();
     }
     public function themHinhAnhSanPham($data){
        return DB::table("tb_hinh_anh_sp")->insert($data);
     }
     public function xoaHinhAnhSanPham($id){
        return DB::table("tb_hinh_anh_sp")->where("san_pham_id",$id)->delete();
     }
   

}
