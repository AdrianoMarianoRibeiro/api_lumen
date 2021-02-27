<?php

namespace App\Http\Requests\User;

use Pearl\RequestValidate\RequestAbstract;

/**
 * Class PostRequest
 * @package App\Http\Requests\User
 */
class PostRequest extends RequestAbstract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'=> ['required'],
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
//            'email' => ['Campo email obrigatório', 'Campo email é do tipo caracter.', 'Email inválido.']
        ];
    }
}
