<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChucVu;

class ChucVuController extends Controller
{
    public $chuc_vu;
    public function __construct()
    {
        $this->chuc_vu= new ChucVu();
    }
    public function index(Request $request)
    {
        $title = "Quản lý chức vụ";
        $tablename = "Danh sách chức vụ";
        $search = $request->input('search');
        $query = ChucVu::query();

        if (!empty($search)) {
            $query->where('ten_chuc_vu', 'LIKE', "%{$search}%");
        }
    
        $listChucVu = $query->get();
    
        return view('admins.chucvus.danhsach', compact('title', 'listChucVu'));
    }
    
    public function create()
    {

        $title = "Thêm chức vụ";

        return view('admins.chucvus.them', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            ChucVu::create($params);
            return redirect()->route('admin.chucvus.index')->with('success', 'Thêm chức vụ thành công!');
        }
    }
    public function edit(string $id)
    {
        $title = "Chỉnh sửa thông tin chức vụ";
        $chucVu = $this->chuc_vu->getDetailPosition($id);
        return view('admins.chucvus.sua', compact('title', 'chucVu'));
    }
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $chucVu = ChucVu::findOrFail($id);
            $chucVu->update($params);
            return redirect()->route('admin.chucvus.index')->with('success', 'Cập nhật thành công!');
        }
    }
    
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod('DELETE')) {

            $chucVu = ChucVu::query()->findOrFail($id);
            $chucVu->delete();
            
                    return redirect()->route('admin.chucvus.index')->with('success', 'Xóa thành công!');
        }
    }
    
}
