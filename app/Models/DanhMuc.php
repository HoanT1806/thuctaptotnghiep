<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DanhMuc extends Model
{
    use SoftDeletes;
    use HasFactory ;
    protected $fillable = [
        'hinh_anh'
        ,'ten_danh_muc'
        ,'mo_ta'
    ]; 
    protected $table = "tb_danh_muc";
    public function getAllDanhMuc(){
        return $this::query()->get();
    }
    public function getDanhMucId($id){
        return $this::query()->where('id',$id)->first();
    }
    public function getList()
    {
        $listDanhMuc = DB::table('tb_danh_muc')
            ->orderBy('id', 'DESC')
            ->get();

        return $listDanhMuc;
    }
    public function createCategory($data)
    {
        DB::table('tb_danh_muc')->insert($data);
    }
    public function getDetailCategory($id)
    {
        $danh_muc = DB::table('tb_danh_muc')->where('id', $id)->first();

        return $danh_muc;
    }
    public function deleteCategory($id)
    {
        DB::table('tb_danh_muc')->where('id', $id)->delete();
    }
}
