<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required|unique:clients,phone',
            'email'=>'required|email|unique:clients,email',
            'password'=>'required|confirmed',
            'governorate_id'=>'required|exists:governorates,id',
            'city_id'=>'required|exists:cities,id',
            'dop'=>'required',
            'last_donation_date'=>'required',
            'blood_type_id'=>'required'
        ];
    }
}
