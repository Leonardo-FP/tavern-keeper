<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBoardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'nickname' => $this->nickname,
            'icon_id'  => $this->icon_id,

            // Dados vindos da tabela pivot
            'is_admin' => (bool) ($this->pivot->is_admin ?? false),
        ];
    }
}