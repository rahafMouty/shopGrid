<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // السماح للجميع
    }

    public function rules()
    {
        return [
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'phone'           => 'required|string|min:6|max:20|unique:users,phone',
            'address'    => 'required|string|max:255',
            'password'        => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'الاسم الأول مطلوب.',
            'last_name.required'  => 'اسم العائلة مطلوب.',
            'email.required'      => 'البريد الإلكتروني مطلوب.',
            'phone.required'      => 'رقم الهاتف مطلوب.',
            'home_address.required' => 'العنوان مطلوب.',
            'password.required'   => 'كلمة المرور مطلوبة.',
        ];
    }
}
