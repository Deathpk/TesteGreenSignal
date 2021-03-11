<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class createNewTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'expectedDate' => 'required',
            'taskOwner' => 'required',
            'taskDescription' => 'required',
            'taskStatus' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'=> 'O campo Titulo é obrigatório.',
            'expectedDate.required'=> 'O campo Data Prevista é obrigatório.',
            'taskOwner.required' => 'O campo Dono da tarefa é obrigatório.',
            'taskDescription.required' => 'O campo Descrição é obrigatório.',
            'taskStatus.required' => 'O campo Status é obrigatório.'
        ];
    }
}
