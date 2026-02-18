<?php

namespace App\Http\Requests;

use App\Enums\CampaignRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCampaignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name'                     => ['required', 'string', 'max:100'],
            'board_id'                 => ['required', 'integer', 'exists:boards,id'],
            'campaign_users'           => ['required', 'array', 'min:1'],
            'campaign_users.*.user_id' => ['required', 'integer', 'exists:users,id', 'distinct'],
            'campaign_users.*.role'    => ['required', Rule::enum(CampaignRole::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O Nome da Campanha é obrigatório.',
            'name.max' => 'O Nome da Campanha não pode ultrapassar 100 caracteres.',
            'campaign_users.min' => 'Adicione pelo menos um participante.',
            'campaign_users.*.role.enum' => 'O papel informado é inválido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nome da Campanha',
            'board_id' => 'Mesa',
            'campaign_users' => 'Usuários da Campanha',
            'campaign_users.*.user_id' => 'Usuário',
            'campaign_users.*.role' => 'Papel',
        ];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $users = collect($this->input('campaign_users'));

            $hasGM = $users->contains(
                fn ($user) => $user['role'] === CampaignRole::GM->value
            );

            if (! $hasGM) {
                $validator->errors()->add(
                    'campaign_users',
                    'A campanha deve ter pelo menos um Mestre.'
                );
            }
        });
    }
}