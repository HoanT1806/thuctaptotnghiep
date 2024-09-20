<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $model;
    public function __construct(SanPham $model)
    {  
        $this->model = $model;
        
    }
    public function index()
    {
        $title = "Quản lý sản phẩm - danh sách sản phẩm";
        $tablename = "Danh sách sản phẩm";
        $data = $this->model->getAllSanPham();
        
       return view("admins.sanphams.danhsach", compact("title", "tablename","data"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $danhmucs = $this->model->getAllDanhMuc();
        $title = "Quản lý sản phẩm - Thêm mới sản phẩm";
       return view("admins.sanphams.them", compact("title","danhmucs"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->isMethod("POST")){
           $data = $request->except(["_token","nhieu_anh"]);
            if($request->hasFile("hinh_anh")){
                $file = $request->file("hinh_anh");
                $filename = time() . "_".$file->getClientOriginalName();
                $file->storeAs("public/uploads/sanphams",$filename);
               $data["hinh_anh"] = $filename;
            }
             $id = $this->model->themSanPham($data)->id;
            
            if($request->hasFile("nhieu_anh")){
                $data = [];
                $nhieu_anh = $request->file("nhieu_anh");

                foreach($nhieu_anh as $file){
                    $filename = time(). "_".$file->getClientOriginalName();
                    $file->storeAs("public/uploads/sanphams",$filename);
                    $data[] = [
                        "san_pham_id" => $id,
                        "link_anh" => $filename
                    ];
                    
                }
                $this->model->themHinhAnhSanPham($data);
            }
            return redirect()->route("admin.sanpham.index")->with("message","Thêm mới sản phẩm thành công");
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
        $danhmucs = $this->model->getAllDanhMuc();
        $title = "Quản lý sản phẩm - Thêm mới sản phẩm";
        $data = $this->model->getSanPhamId($id);
      
       return view("admins.sanphams.sua", compact("title","danhmucs","data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod("PUT")){
            $sanpham = SanPham::find($id);
           $data = $request->except("_token","_method","nhieu_anh");
            if($request->hasFile("hinh_anh")){
            
                if($sanpham->hinh_anh && Storage::disk("public")->exists("/uploads/sanphams/".$sanpham->hinh_anh)){
                    Storage::disk("public")->delete("/uploads/sanphams/".$sanpham->hinh_anh);
                }
                $file = $request->file("hinh_anh");
                $filename = time(). "_".$file->getClientOriginalName();
                $file->storeAs("public/uploads/sanphams",$filename);
                 $data["hinh_anh"] = $filename;
            }
            $this->model->suaSanPhamm($data,$id);
            if($request->hasFile("nhieu_anh")){
                $data = [];
                $nhieu_anh = $request->file("nhieu_anh");

                foreach($nhieu_anh as $file){
                    $filename = time(). "_".$file->getClientOriginalName();
                    $file->storeAs("public/uploads/sanphams",$filename);
                    $data[] = [ 
                        "san_pham_id" => $id,
                        "link_anh" => $filename
                    ];
                    
                }
                $this->model->xoaHinhAnhSanPham($id);
                $this->model->themHinhAnhSanPham($data);
            }
          

            return redirect()->route("admin.sanpham.index")->with("message","Cập nhật sản phẩm thành công");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanpham = SanPham::find($id);
      $this->model->xoaSanPham($id);
       if($sanpham->hinh_anh && Storage::disk("public")->exists("/uploads/sanphams/".$sanpham->hinh_anh)){
        Storage::disk("public")->delete("/uploads/sanphams/".$sanpham->hinh_anh);
            }
   
        return redirect()->route("admin.sanpham.index")->with("message","Xóa sản phẩm thành công");
        
    }
}