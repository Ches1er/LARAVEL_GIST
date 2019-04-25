<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileValidation extends FormRequest
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
                'name'=>'required|min:2',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Name field is required',
            'name.min'=>'Name field has to contain at least 2 symbols',
        ];
    }
}
