<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:10000'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'O conteúdo da mensagem é obrigatório.',
            'content.string' => 'O conteúdo precisa ser um texto.',
            'content.max' => 'A mensagem não pode ultrapassar 10.000 caracteres.',
        ];
    }
}