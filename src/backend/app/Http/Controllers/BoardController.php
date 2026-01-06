<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardStoreRequest;
use Illuminate\Http\Request;
use App\Services\BoardService;

class BoardController extends Controller
{
    protected BoardService $service;

    public function __construct(BoardService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    public function store(BoardStoreRequest $request)
    {
        $board = $this->service->create($request->validated());

        return response()->json($board, 201);
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
