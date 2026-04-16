<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'status_id' => [
                'required', 
                'integer', 
                Rule::exists('statuses', 'id')->where('type', 'campaign'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O Nome da Campanha é obrigatório.',
            'name.max' => 'O Nome da Campanha não pode ultrapassar 100 caracteres.',
            'status_id.required' => 'É necessário informar um Status da Campanha.',
            'status_id.integer' => 'O ID do Status da Campanha precisa ser um número inteiro.',
            'status_id.exists' => 'É necessário informar um Status de Campanha válido.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome da Campanha',
            'status_id' => 'Status da Campanha',
        ];
    }
}
