<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignSessionRequest;
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

    public function show(CampaignSession $campaignSession)
    {
        //
    }

    public function update(Request $request, CampaignSession $campaignSession)
    {
        //
    }

    public function destroy($campaignId, CampaignSession $campaignSession)
    {
        $this->authorize('delete', $campaignSession);

        $this->service->delete($campaignSession);

        return response()->noContent();
    }
}
