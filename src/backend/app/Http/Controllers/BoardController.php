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
        $board_details = $this->service->show($id);

        return response()->json($board_details, 200);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function myBoards()
    {
        $boards = $this->service->getMyBoards();

        return response()->json($boards, 200);
    }
}
