<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $don_hang;
    public function __construct()
    {
        $this->don_hang= new DonHang();
    }
    public function index()
    {
$dsDonHang= $this->don_hang->getList();
$title = "Quản lý đơn hàng";
$tablename = "Danh sách đơn hàng"; 
return view('admins.donhangs.dsdonhang',compact('title','tablename','dsDonHang'));
    //   dd('day la trang don hang');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Sửa đơn hàng";
        $donHang=$this->don_hang->getTTDonHang($id);
        return view('admins.donhangs.updatedonhang',compact('title','donHang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->isMethod('PUT')){
            $params = $request->except('_token', '_method');
            // dd($params);
            $this->don_hang->updateDonHang($id,$params);
            return redirect()->route('donhang.index');
        }
        // $params = $request->post();
        // dd($params);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
