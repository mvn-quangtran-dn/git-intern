<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\WhiteListEmailDomain;


class CreateUserRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => 'required|numeric',// ['required', 'numeric']
            'name' => 'required|min:3|max:10',
            'country_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email bat buoc',
            'email.email' => 'format email bi sai',
            'password.required' => 'Bat buoc nhap'
        ];
    }
}
