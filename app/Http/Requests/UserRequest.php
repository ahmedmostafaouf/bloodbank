<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' =>'required|max:20',
            'last_name' =>'required|max:20',
            'email' =>'required|email|unique:users,email,'.$this->id,
            'password' =>'required|confirmed',
            'permission' =>'required|min:1',
        ];
    }
    public function messages()
    {
        return [
            "first_name.required"=>' يجب ادخال الاسم الاول',
            "last_name.required"=>' يجب ادخال الاسم الاخير',
            "email.required"=>'يجب ادخال الاميل',
            "email.email"=>'يجب ان يكون اميل',
            "password.required"=>'يجب ادخال كلمه المرور',
        ];
    }
}
