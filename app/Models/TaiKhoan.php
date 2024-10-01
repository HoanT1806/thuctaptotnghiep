<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTok    ens;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaiKhoan extends Authenticatable
{
    use Notifiable,SoftDeletes;
    const role_admin = 1;
    const role_user = 2;
    protected $table = 'tb_tai_khoan';

    protected $fillable = [
        'anh_dai_dien',
        'ho_ten',
        'email',
        'so_luong',
        'so_dien_thoai',
        'gioi_tinh',
        'dia_chi',
        'ngay_sinh',
        'mat_khau',
        'chuc_vu_id',
        'trang_thai',
    ];

    protected $hidden = [
        'mat_khau',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mat_khau' => 'hashed',
    ];

    public function getAllTaiKhoan(){
        $data = DB::table("tb_tai_khoan")
        ->join("tb_chuc_vu", "tb_tai_khoan.chuc_vu_id", "=", "tb_chuc_vu.id")
        ->select("tb_tai_khoan.ho_ten" , "tb_tai_khoan.id", "tb_tai_khoan.email", "tb_tai_khoan.dia_chi", "tb_tai_khoan.trang_thai" , "tb_tai_khoan.so_dien_thoai", "tb_chuc_vu.ten_chuc_vu")
        ->get()->toArray();
        return $data;
    }
    public function getTaiKhoanId($id){
        return DB::table("tb_tai_khoan")->where("id",$id)->get()->first();
        
 
    }
    public function getAllChucVu(){
        return DB::table("tb_chuc_vu")->get();
    }
     public function themTaiKhoan($data){
        return self::query()->create($data);
     }
     public function suaTaiKhoan($data,$id){
        return self::query()->where("id",$id)->update($data);
     }
     public function xoaTaiKhoan($id){
        return self::query()->where("id",$id)->delete();
     }
     public function xoaHinhAnhTaiKhoan($id){
        return DB::table("tb_hinh_anh_sp")->where("san_pham_id",$id)->delete();
     }
     public function getAuthPassword()
     {
         return $this->mat_khau;
     }

}
