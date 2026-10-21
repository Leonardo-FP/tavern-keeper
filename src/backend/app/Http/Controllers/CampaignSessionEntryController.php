<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionEntryRequest;
use App\Models\Campaign;
use App\Models\CampaignSession;
use App\Services\CampaignSessionEntryService;
use Illuminate\Http\JsonResponse;

class CampaignSessionEntryController extends Controller
{
    public function __construct(
        private CampaignSessionEntryService $service
    ) {}

    public function store(
        StoreSessionEntryRequest $request,
        Campaign $campaign,
        CampaignSession $session
    ): JsonResponse {
        abort_unless(
            $session->campaign_id === $campaign->id,
            404
        );

        $this->authorize('view', $session);

        $entry = $this->service->create(
            $session,
            $request->user(),
            $request->validated('content')
        );

        return response()->json($entry, 201);
    }
}