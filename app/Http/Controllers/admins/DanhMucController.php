<?php

namespace App\Http\Controllers\admins;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DanhMucRequest;


class DanhMucController extends Controller
{
    public $danh_muc;
    public function __construct()
    {
        $this->danh_muc = new DanhMuc();
    }
    public function index(Request $request)
    {
        $listDanhMuc = DanhMuc::query();
        if($request->has('search')){
            $listDanhMuc->where("ten_danh_muc","like","%".$request->get('search')."%");
        }
        $listDanhMuc = $listDanhMuc->paginate(5);
        $title = "Quản lý sản phẩm - danh sách sản phẩm";
        $tablename = "Danh sách danh mục";
        return view('admins.danhmucs.danhsach', compact('title', 'listDanhMuc'));
    }
    public function create()
    {
        $title = "Thêm danh mục";
        return view('admins.danhmucs.them', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DanhMucRequest $request)

    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            if ($request->hasFile('hinh_anh')) {
                $filename = $request->file('hinh_anh')->store('public/uploads/danhmucs');
            } else {
                $filename = null;
            }
            $params['hinh_anh'] = $filename;
            DanhMuc::create($params);
            return redirect()->route('admin.danhmucs.index')->with('success', 'Thêm danh mục thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Chỉnh sửa thông tin danh mục";
        $danhMuc = $this->danh_muc->getDetailCategory($id);
        return view('admins.danhmucs.sua', compact('title', 'danhMuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DanhMucRequest $request, string $id)

    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $danhMuc = DanhMuc::findOrFail($id);
            if ($request->hasFile('hinh_anh')) {
                if ($danhMuc->hinh_anh) {
                    Storage::disk('public')->delete($danhMuc->hinh_anh);
                }
                $params['hinh_anh'] = $request->file('hinh_anh')->store('public/uploads/danhmucs');
            } else {
                $params['hinh_anh'] = $danhMuc->hinh_anh;
            }
            $danhMuc->update($params);
            return redirect()->route('admin.danhmucs.index')->with('success', 'Cập nhật danh mục thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod('DELETE')) {

            $danhMuc = DanhMuc::query()->findOrFail($id);
            $danhMuc->delete();
            if ($danhMuc->hinh_anh && Storage::disk('public')->exists($danhMuc->hinh_anh)) {
                        Storage::disk('public')->delete($danhMuc->hinh_anh);
                    }
                    return redirect()->route('admin.danhmucs.index')->with('success', 'Xóa danh mục thành công!');
        }
    }
}
