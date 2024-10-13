<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pttt extends Model
{
    use HasFactory;
    protected $table = "tb_phuong_thuc_thanh_toan";     
    public function getList() {
     $dsPttt = DB::table('tb_phuong_thuc_thanh_toan')->get();
     return $dsPttt;
    }
    public function createPttt($data){
        DB::table('tb_phuong_thuc_thanh_toan')->insert($data);
    }
    public function getDetailPttt($id){
        $dsPttt=DB::table('tb_phuong_thuc_thanh_toan')->where('id',$id)->first();
    return $dsPttt;
    }
    public function updatePttt($id,$params){
        DB::table('tb_phuong_thuc_thanh_toan')->where('id',$id)->update($params);
    }
    public function deletePttt($id){
        DB::table('tb_phuong_thuc_thanh_toan')->where('id',$id)->delete();
    }
}
