<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChucVu extends Model
{
    use HasFactory ;
    protected $fillable = [
        'ten_chuc_vu'
    ]; 
    protected $table = "tb_chuc_vu";
    public function getAllChucVu(){
        return $this::query()->get();
    }
    public function getChucVuId($id){
        return $this::query()->where('id',$id)->first();
    }
    public function getList()
    {
        $listChucVu = DB::table('tb_chuc_vu')
            ->orderBy('id', 'DESC')
            ->get();

        return $listChucVu;
    }

    public function createPosition($data)
    {
        DB::table('tb_chuc_vu')->insert($data);
    }

    Public function getDetailPosition($id)
    {
        $chuc_vu = DB::table('tb_chuc_vu')->where('id', $id)->first();

        return $chuc_vu;
    }

}
