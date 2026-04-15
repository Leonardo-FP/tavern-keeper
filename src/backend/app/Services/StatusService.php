<?php

namespace App\Services;

use App\Models\Status;

class StatusService
{
    public function getAll(?string $type = null)
    {
        $query = Status::query();

        if ($type) {
            $query->where('type', $type);
        }

        return $query->get();
    }
}
