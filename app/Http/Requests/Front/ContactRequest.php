<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'subject' => 'required|string|min:10|max:100',
            'message' => 'required|string|min:30|max:300',
        ];
    }  public function messages()
    {
        return [
            'subject.required' => 'يجب كتابه عنوان الرساله',
            'message.required' => 'يجب كتابه موضوع الرساله',
            'subject.string' => 'يجب ان يكون عنوان الرساله احرف',
            'message.string' => 'يجب ان يكون موضوع الرساله احرف',
            'subject.min' => 'يجب ان يكون عنوان الرساله علي الاقل 10 احرف',
            'message.min' => 'يجب ان يكون موضوع الرساله علي الاقل 30 حرف',
        ];
    }
}
