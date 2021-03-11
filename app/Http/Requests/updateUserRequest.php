<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class updateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user() ? true : false;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:162',
            'telephone' => 'required|string|min:10|max:11',
            'email' => 'required|email|max:255',
            'newEmail' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'newPassword' => 'required|string|min:8|confirmed' 
        ];
    }

    public function message()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome deve conter no minimo 2 Caracteres.',
            'name.max' => 'O campo nome deve conter no máximo 162 Caracteres.',

            'telephone.required' => 'O campo telefone é obrigatório.',
            'telephone.min' => 'O campo telefone deve conter no minimo 2 digitos.',
            'telephone.max' => 'O campo telefone deve conter no maximo 11 digitos.',

            'email.required' => 'O campo novo e-mail é obrigatório.',
            'email.email' => 'Insira um endereço de  novo email valido.',
            'email.max' => 'O campo novo e-mail deve conter no máximo 255 caracteres.',
            
            'newEmail.required' => 'O campo novo e-mail é obrigatório.',
            'newEmail.email' => 'Insira um endereço de novo email valido.',
            'newEmail.max' => 'O campo novo e-mail deve conter no máximo 255 caracteres.',
            
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'O campo senha deve conter no minimo 8 caracteres.',
            
            'newPassword.required' => 'O campo nova senha é obrigatório.',
            'newPassword.min' => 'O campo nova senha deve conter no minimo 8 caracteres.',
            'newPassword.confirmed' => 'O campo nova senha deve ser confirmado.'

        ];
    }
}
