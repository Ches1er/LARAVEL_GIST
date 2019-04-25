<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileValidation extends FormRequest
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
            'file_name'=>'required|min:2',
            'file_content'=>'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'file_name.required'=>'Name field is required',
            'file_name.min'=>'Name field has to contain at least 2 symbols',
            'file_content.required'=>'File content is required',
            'file_content.min'=>'Content has to contain at least 2 symbols',
        ];
    }
}
