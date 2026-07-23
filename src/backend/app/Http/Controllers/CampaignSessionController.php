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

    public function store(StoreCampaignSessionRequest $request, $campaignId)
    {
        $campaignSession = $this->service->create($request->validated());

        return response()->json($campaignSession, 201);
    }

    public function show(Campaign $campaign, CampaignSession $session)
    {
        $session_details = $this->service->show($session->id);

        return response()->json($session_details, 200);
    }

    public function update(Request $request, CampaignSession $campaignSession)
    {
        //
    }

    public function destroy(Campaign $campaign, CampaignSession $session)
    {
        $this->authorize('delete', $session);

        $this->service->delete($session);

        return response()->noContent();
    }
}
