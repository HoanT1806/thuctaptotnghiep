<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Pttt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PtttController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $dsPttt;
    public function __construct()
    {
        $this->dsPttt= new Pttt();
    }
    public function index(Request $request)
    {
        $title = "Quản lý phương thức thanh toán";
        $tablename = "Danh sách phương thức thanh toán";
        
        $search = $request->input('search');
        
        // Query tìm kiếm
        $query = DB::table('tb_phuong_thuc_thanh_toan');
        
        if ($search) {
            $query->where('ten_phuong_thuc', 'like', "%{$search}%");
        }
        
        $dsPttt = $query->get();
        
        return view('admins.donhangs.pttt', compact('title', 'tablename', 'dsPttt'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mới phương thức thanh toán";
        // $tablename = "Danh sách phương thức thanh toán";  
        return view('admins.donhangs.addpttt',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $params = $request->post();
        // dd($params);
        if($request->isMethod('POST')){
            $params = $request->except('_token');
            // dd($params);
            $this->dsPttt->createPttt($params);
            return redirect()->route('admin.pttt.index');
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
        $title = "Sửa phương thức thanh toán";
        $dsPttt= $this->dsPttt->getDetailPttt($id);
       return view('admins.donhangs.updatepttt',compact('title','dsPttt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('PUT')){
            $params = $request->except('_token', '_method');
            $this->dsPttt->updatePttt($id,$params);
            return redirect()->route('admin.pttt.index');
        }
        // $params = $request->post();
        // dd($params);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->dsPttt->deletePttt($id);
        return view('pttt.index');
    }
}
