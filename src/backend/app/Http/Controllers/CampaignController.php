<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Services\CampaignService;
use App\Models\Campaign;

class CampaignController extends Controller
{
    protected CampaignService $service;

    public function __construct(CampaignService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    public function store(StoreCampaignRequest $request)
    {
        $campaign = $this->service->create($request->validated());

        return response()->json($campaign->load('status'), 201);
    }

    public function show(string $id)
    {
        $campaign_details = $this->service->show($id);

        return response()->json($campaign_details, 200);
    }

    public function update(UpdateCampaignRequest $request, string $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        $this->authorize('update', $campaign);

        $campaign = $this->service->update(
            $request->validated(),
            $campaign
        );

        return response()->json($campaign, 200);
    }

    public function destroy(Campaign $campaign)
    {
        //
    }

    public function myCampaigns()
    {
        $campaigns = $this->service->getMyCampaigns();

        return response()->json($campaigns, 200);
    }

    public function join(int $campaign_id){
        $campaign = $this->service->join($campaign_id);

        return response()->json($campaign, 200);
    }

    public function leave(int $campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $user = auth()->user();

        $this->service->leave($campaign, $user);

        return response()->noContent();
    }
}
