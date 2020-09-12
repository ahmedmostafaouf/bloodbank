<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'photo'=>'required_without:id|mimes:jpg,png,jpeg',
            'title'=>'required|string',
            'contents'=>'required|string|min:5',
            'category_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'photo.required_without'=>'يجب ادخال صوره',
            'photo.mimes'=>' يجب ادخال لوجو بهذه الصيغ (jpg or png or jpeg)',
            'title.required'=>'يجب ادخال عنوان',
            'title.string'=>'يجب ان يحتوي العنوان علي احرف وارقام',
            'content.required'=>'يجب ادخال المقالة',
            'content.string'=>'يجب ان تحتوي المثالة علي احرف وارقام',
            'content.min'=>'يجب ان تكون ع الاقل 5 احرف',
            'category_id.required'=>'يجب ان تختار قسم',


        ];
    }
}
