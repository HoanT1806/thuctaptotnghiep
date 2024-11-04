<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\TaiKhoan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Đăng nhập
public function showFormLogin()  {
    $title ="Login";
    return view ('auth.login',compact('title'));
}
public function login(LoginRequest $request)
{

    $credentials = $request->only('email', 'mat_khau'); // Lấy thông tin đăng nhập từ yêu cầu
   $credentials["password"] = $credentials["mat_khau"];
   unset($credentials["mat_khau"]);
    if (Auth::attempt($credentials)) {
// login thành công

return redirect()->route('adminhome');

  
    } else {
       //login thất bại
        return redirect()->back()
            ->withInput()
            ->withErrors(['login' => 'Thông tin đăng nhập không chính xác']);
    }

} 
   //Đăng ký
   public function showFormRegister()  {
    $title ="Register";
    return view('auth.register',compact('title'));
    
   }
   public function register(RegisterRequest $request)
   {
   
    $data = $request->except('_token');
    $data['mat_khau'] = Hash::make($data['mat_khau']);
    $data['chuc_vu_id'] = 1; // Chức vụ admin mặc đ��nh

   $user = TaiKhoan::query()->create($data);
//    Auth::login($user);
   return redirect()->route('login')->with('success', 'Đăng ký tài khoản mới thành công!');

   } 
    //Đăng xuất
    public function logout(Request $request){
        Auth::logout();
        
        return redirect('/login');
    }
}
