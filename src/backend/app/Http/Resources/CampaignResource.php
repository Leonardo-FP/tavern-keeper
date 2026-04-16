<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
            'board_id' => $this->board_id,
            'is_logged_user_gm' => $this->relationLoaded('users')
                ? $this->users
                    ->where('id', auth()->id())
                    ->first()?->pivot?->role === 'gm'
                : $this->isGm(auth()->user()),

            // Status da campanha
            'status' => $this->when(
                $this->relationLoaded('status'),
                fn () => [
                    'id'   => $this->status->id,
                    'name' => $this->status->name,
                    'status_color' => $this->status->status_color,
                ]
            ),

            // Usuários da campanha
            'users' => $this->when(
                $this->relationLoaded('users'),
                fn () => $this->users->map(fn ($user) => [
                    'id'   => $user->id,
                    'nickname' => $user->nickname,
                    'role' => $user->pivot->role ?? null
                ]),
            ),

            // Sessões da campanha
            'sessions' => $this->when(
                $this->relationLoaded('sessions'),
                fn () => $this->sessions->map(fn ($session) => [
                    'id'   => $session->id,
                    'title' => $session->title,
                    'description' => $session->description
                ]),
            ),
        ];
    }
}