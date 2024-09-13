<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|email|string',
            'ho_ten'=>'required|max:255|string',
            'mat_khau'=>'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required'=>'Bạn cần nhập email',
            'email.string'=>'Bạn cần nhập email là chữ',
            'email.email'=>'Bạn cần nhập email đúng định dạng',
            'ho_ten.required'=>'Bạn cần nhập họ tên',
            'ho_ten.string'=>'Bạn cần nhập họ tên là chữ',
            'ho_ten.max'=>'Họ tên không quá 255 ký tự',
            'mat_khau.required'=>'Vui lòng nhập mật khẩu',
        ];
    }
}
