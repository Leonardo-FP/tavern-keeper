<?php

namespace App\Services;

use App\Models\Board;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\BoardResource;
use App\Models\User;

class BoardService
{
    public function create(array $data)
    {
        // Se password for informado
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $board = Board::create($data);

        // Adicionar o usuário criador como admin
        $board->users()->attach(auth()->id(), ['is_admin' => 1]);

        return $board;
    }

    public function update(array $data, Board $board)
    {
        $board->name = $data['name'];
        $board->is_private = $data['is_private'];
        $board->users_limit = $data['users_limit'];

        // Atualiza senha apenas se vier preenchida
        if (!empty($data['password'])) {
            $board->password = Hash::make($data['password']);
        }

        // Limpar a senha ao tornar a mesa pública
        if (!$data['is_private']) {
            $board->password = null;
        }

        $board->save();

        return $board;
    }

    public function show($id)
    {
        $board = Board::with(['campaigns.status', 'users'])->findOrFail($id);

        return new BoardResource($board);
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

    public function removeUser(Board $board, User $user)
    {
        if(!$board->users()->where('user_id', $user->id)->exists()){
            throw new \Exception('Usuário não pertence a esta mesa');
        }

        $board->users()->detach($user->id);

        return true;
    }

    public function leave(Board $board, User $user)
    {
        if(!$board->users()->where('user_id', $user->id)->exists()){
            throw new \Exception('Você não pertence à mesa para deixá-la.');
        }

        $board->users()->detach($user->id);

        return true;
    }
}
