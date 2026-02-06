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

            // Status da campanha
            'status' => $this->when(
                $this->relationLoaded('status'),
                fn () => [
                    'id'   => $this->status->id,
                    'name' => $this->status->name,
                    'status_color' => $this->status->status_color,
                ]
            ),
        ];
    }
}