<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            "about_app"=>'required|string',
            "fb_url"=>'required|url',
            "tw_url"=>'required|url',
            "youtube_url"=>'required|url',
            "insta_url"=>'required|url',
            "phone"=>'required|digits:11|numeric',
            "email"=>'required|email',
        ];
    }
    public function messages()
    {
        return [
            "about_app.required"=>'يجب ادخال نبذه عن التطبيق',
            "fb_url.required"=>'يجب ادخال لينك ',
            "fb_url.url"=>'يجب ان يكون لينك صحيح',
            "tw_url.required"=>'يجب ادخال لينك ',
            "tw_url.url"=>'يجب ان يكون لينك صحيح',
            "insta_url.required"=>'يجب ادخال لينك ',
            "insta_url.url"=>'يجب ان يكون لينك صحيح',
            "youtube_url.required"=>'يجب ادخال لينك ',
            "youtube_url.url"=>'يجب ان يكون لينك صحيح',
            "phone.required"=>'يجب ادخال رقم هاتف',
            "phone.digits"=>'يجب ان يكون الهاتف 11 رقم',
            "email.required"=>'يجب ادخال ايميل',
            "email.email"=>'يجب ان يكون الاميل صحيح',

                    ];
    }
}
