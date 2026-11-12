<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Notice;
use App\Services\NoticeService;
use Illuminate\Support\Facades\Gate;

class NoticeController extends Controller
{
    protected NoticeService $service;

    public function __construct(NoticeService $service)
    {
        $this->service = $service;
    }

    public function index(Board $board){
        Gate::authorize('viewAny', [Notice::class, $board]);

        $board_notices = $this->service->listForBoard($board);

        return response()->json($board_notices, 200);
    }
}