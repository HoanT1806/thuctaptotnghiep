<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\BinhLuanRequest;
use App\Models\BinhLuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BinhLuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $title = "Quản lý bình luận";
    $tablename = "Quản lý bình luận";
    
    // Nhận giá trị tìm kiếm từ request
    $search = $request->input('search');
    
    // Thực hiện truy vấn với điều kiện tìm kiếm
    $query = DB::table('tb_binh_luan as bl')
        ->join('tb_tai_khoan as tk', 'bl.tai_khoan_id', '=', 'tk.id')
        ->join('tb_san_pham as sp', 'bl.san_pham_id', '=', 'sp.id')
        ->select(
            'tk.id as tai_khoan_id',
            'tk.ho_ten',
            DB::raw('COUNT(DISTINCT sp.id) as so_luong_san_pham'),
            DB::raw('COUNT(bl.id) as so_luong_binh_luan')
        )
        ->groupBy('tk.id', 'tk.ho_ten')
        ->havingRaw('COUNT(bl.id) > 0');
    
    // Thêm điều kiện tìm kiếm nếu có giá trị tìm kiếm
    if (!empty($search)) {
        $query->where('tk.ho_ten', 'like', '%' . $search . '%');
    }

    // Lấy kết quả truy vấn
    $comments = $query->get();

    return view('admins.binhluans.danhsach', compact('title', 'tablename', 'comments'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $title = "Quản lý bình luận";
        $tablename = "Quản lý bình luận";
    
        // Nhận giá trị tìm kiếm từ request
        $search = $request->input('search');
        $trang_thai = $request->input('trang_thai');
    
        // Thực hiện truy vấn với điều kiện tìm kiếm
        $query = DB::table('tb_binh_luan as bl')
            ->join('tb_tai_khoan as tk', 'bl.tai_khoan_id', '=', 'tk.id')
            ->join('tb_san_pham as sp', 'bl.san_pham_id', '=', 'sp.id')
            ->select(
                'bl.id as binh_luan_id',
                'tk.id as tai_khoan_id',
                'sp.ten_san_pham',
                'tk.ho_ten',
                'bl.noi_dung',
                'bl.trang_thai'
            )
            ->where('bl.tai_khoan_id', $id);
    
        // Thêm điều kiện tìm kiếm nếu có giá trị tìm kiếm
        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('sp.ten_san_pham', 'like', '%' . $search . '%')
                      ->orWhere('bl.noi_dung', 'like', '%' . $search . '%');
            });
        }
    
        if (!empty($trang_thai)) {
            $query->where('bl.trang_thai', $trang_thai);
        }
    
        // Lấy kết quả truy vấn
        $comments = $query->get();
    
        return view('admins.binhluans.showbl', compact('title', 'tablename', 'comments', 'id'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $binhluan = BinhLuan::query()->findOrFail($id);
        return view('admins.binhluans.edit',compact('binhluan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BinhLuanRequest $request, string $id)
    {
       $binhluan = $request->get('trang_thai');
       BinhLuan::query()->where('id', $id)->update(['trang_thai' =>   $binhluan]);
       return redirect()->route('admin.binhluan.index');
    //    dd($binhluan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
