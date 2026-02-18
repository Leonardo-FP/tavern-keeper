<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
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

        return response()->json($campaign, 201);
    }

    public function show(Campaign $campaign)
    {
        //
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        //
    }

    public function destroy(Campaign $campaign)
    {
        //
    }
}
