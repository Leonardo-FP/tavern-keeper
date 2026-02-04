<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'is_private'  => (bool) $this->is_private,
            'users_limit' => $this->users_limit,
            'is_logged_user_admin' => $this->users
                ->where('id', auth()->id())
                ->first()?->pivot?->is_admin ?? false,

            // Campanhas da mesa
            'campaigns' => CampaignResource::collection(
                $this->whenLoaded('campaigns')
            ),

            // Membros da mesa
            'users' => UserBoardResource::collection(
                $this->whenLoaded('users')
            ),
        ];
    }
}