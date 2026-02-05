<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardStoreRequest;
use App\Models\Board;
use App\Models\User;
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

    public function update(BoardStoreRequest $request, string $id)
    {
        $board = Board::findOrFail($id);
        
        $this->authorize('update', $board);

        $board = $this->service->update(
            $request->validated(),
            $board
        );

        return response()->json($board, 200);
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

    public function removeUser($board_id, $user_id)
    {
        $board = Board::findOrFail($board_id);
        $user = User::findOrFail($user_id);

        $this->authorize('removeUsers', $board);

        $this->service->removeUser($board, $user);

        return response()->noContent();
    }

    public function leave($board_id)
    {
        $board = Board::findOrFail($board_id);
        $user = auth()->user();

        $this->service->leave($board, $user);

        return response()->noContent();
    }
}
