<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;   
    }
    public function rules()
    {
        return [
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Campo Obrigatorio!',
            'email.required' => 'Campo Obrigatorio!',
            'password.required' => 'Campo Obrigatorio!'
        ]; 
    }
}