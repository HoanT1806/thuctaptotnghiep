<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DanhMucRequest extends FormRequest
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
            'ten_danh_muc' => 'required|max:255',
                //ma_san_pham' => 'required|max:10|unique:tb_san_pham,ma_san_pham'. $this->route('sanpham'),
                //gia=> 'required|numeric|min:1|max:999999999',
                //so_luong=>'required|numeric|min:1
                //ngay_nhap=>required|date
        ];
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
    return [
            //messege
            'ten_danh_muc.required' => 'Tên danh mục không được để trống',
            'ten_danh_muc.max' => 'Tên danh mục không quá 100 ký tự',
        
    ];
}
}
