<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoardRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Se o usuário está autenticado via Sanctum, pode criar
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'is_private' => ['required', 'boolean'],
            'password' => ['nullable', 'string', 'max:50'],
            'users_limit' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O Nome da Mesa é obrigatório.',
            'name.max' => 'O Nome da Mesa não pode ultrapassar 100 caracteres.',
            'users_limit.required' => 'O Limite de Jogadores deve ser informado.',
            'users_limit.min' => 'A mesa precisa ter pelo menos 1 jogador!',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome da Mesa',
            'is_private' => 'Visibilidade da Mesa',
            'password' => 'Senha',
            'users_limit' => 'Limite de Jogadores',
        ];
    }
}
