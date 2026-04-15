<?php

namespace App\Http\Controllers;

use App\Services\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected StatusService $service;

    public function __construct(StatusService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $statuses = $this->service->getAll($request->type);

        return response()->json($statuses, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
