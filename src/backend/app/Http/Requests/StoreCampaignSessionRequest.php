<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:100'],
            'campaign_id' => ['required', 'integer', 'exists:campaigns,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O Nome da Sessão é obrigatório.',
            'title.max'      => 'O Nome da Sessão não pode ultrapassar 100 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'        => 'Nome da Sessão',
            'campaign_id' => 'Campanha',
        ];
    }
}