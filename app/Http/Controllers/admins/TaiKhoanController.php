<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Storage;
class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $model;
    public function __construct(TaiKhoan $model)
    {  
        $this->model = $model;
        
    }
    public function index()
    {
        $title = "Quản lý tài khoản - danh sách tài khoản";
        $tablename = "Danh tài khoản";
        $data = TaiKhoan::get();

       return view("admins.taikhoans.danhsach", compact("title", "tablename","data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chucvus = $this->model->getAllChucVu();
        $title = "Quản lý sản phẩm - Thêm mới tài khoản";
       return view("admins.taikhoans.them", compact("title","chucvus"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod("POST")){
           $data = $request->except(["_token","xac_nhan_mk"]);
            if($request->hasFile("anh_dai_dien")){
                $file = $request->file("hinh_anh");
                $filename = time() . "_".$file->getClientOriginalName();
                $file->storeAs("public/uploads/taikhoan",$filename);
               $data["hinh_anh"] = $filename;
            }
             $id = $this->model->themTaiKhoan($data);
            
            return redirect()->route("admin.taikhoan.index")->with("message","Thêm mới tài khoản thành công");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
        $title = "Quản lý tài khoản - Sửa tài khoản";
        $data = $this->model->getTaiKhoanId($id);
        $chucvus = $this->model->getAllChucVu();
    
       return view("admins.taikhoans.sua", compact("title","data","chucvus"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod("PUT")){
           $data = $request->except("_token","_method");
           $taikhoan = TaiKhoan::find($id);
            if($request->hasFile("anh_dai_dien")){
                if($taikhoan->anh_dai_dien && Storage::disk("public")->exists("uploads/taikhoan/".$taikhoan->anh_dai_dien)){
                    Storage::disk("public")->delete("uploads/taikhoan/".$taikhoan->anh_dai_dien);  // Xóa file c�� đi để đ��i ảnh mới
                }
                $file = $request->file("anh_dai_dien");
                $filename = time(). "_".$file->getClientOriginalName();
                $file->storeAs("public/uploads/taikhoan",$filename);
               $data["anh_dai_dien"] = $filename;
            }
        
            $this->model->suaTaiKhoan($data,$id);
            return redirect()->route("admin.taikhoan.index")->with("message","Cập nhật tài khoản thành công");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taikhoan = TaiKhoan::find($id);
        dd($taikhoan);
        if($taikhoan->anh_dai_dien && Storage::disk("public")->exists("uploads/taikhoan/".$taikhoan->anh_dai_dien)){
            Storage::disk("public")->delete("uploads/taikhoan/".$taikhoan->anh_dai_dien);  // Xóa file c�� đi để đ��i ảnh mới
        }
        $this->model->xoaTaiKhoan($id);
        return redirect()->route("admin.taikhoan.index")->with("message","Xóa sản phẩm thành công");
        
    }
   
}
