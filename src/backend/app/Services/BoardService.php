<?php

namespace App\Services;

use App\Models\Board;
use Illuminate\Support\Facades\Hash;

class BoardService
{
    public function create(array $data)
    {
        // Se password for opcional
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $board = Board::create($data);

        // Adicionar o usuário criador como admin
        $board->users()->attach(auth()->id(), ['is_admin' => 1]);

        return $board;
    }

    public function show(int $id)
    {
        return Board::find($id);
    }

    public function getMyBoards()
    {
        return auth()
            ->user()
            ->boards()
            ->withCount(['users as current_players'])
            ->latest()
            ->paginate(6);
    }
}
