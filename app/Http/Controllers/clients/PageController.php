<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
class PageController extends Controller
{
    public function about()
    {
        $title = "Giới thiệu"; // Định nghĩa biến title
        $danhmucs = DanhMuc::all(); // Lấy tất cả danh mục từ cơ sở dữ liệu

        return view('clients.about', compact('title', 'danhmucs')); // Truyền biến đến view
    }
}