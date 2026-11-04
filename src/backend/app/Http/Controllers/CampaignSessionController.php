<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignSessionRequest;
use App\Models\Campaign;
use App\Models\CampaignSession;
use App\Services\CampaignSessionService;
use Illuminate\Http\Request;

class CampaignSessionController extends Controller
{
    protected CampaignSessionService $service;

    public function __construct(CampaignSessionService $service)
    {
        $this->service = $service;
    }
    
    public function index()
    {
        //
    }

    public function store(StoreCampaignSessionRequest $request, Campaign $campaign)
    {
        $this->authorize('create', [CampaignSession::class, $campaign]);

        $campaignSession = $this->service->create([
            ...$request->validated(),
            'campaign_id' => $campaign->id,
        ]);

        return response()->json($campaignSession, 201);
    }

    public function show(Campaign $campaign, CampaignSession $session)
    {
        abort_unless(
            $session->campaign_id === $campaign->id,
            404
        );

        $this->authorize('view', $session);
    
        $session_details = $this->service->show($session->id);

        return response()->json($session_details, 200);
    }

    public function update(Request $request, CampaignSession $campaignSession)
    {
        //
    }

    public function destroy(Campaign $campaign, CampaignSession $session)
    {
        abort_unless($session->campaign_id === $campaign->id, 404);

        $this->authorize('delete', $session);

        $this->service->delete($session);

        return response()->noContent();
    }
}
