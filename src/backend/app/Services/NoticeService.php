<?php

namespace App\Services;

use App\Models\Board;
use App\Models\Campaign;
use App\Models\Notice;

class NoticeService
{
   public function listForBoard(Board $board, ?Campaign $campaign = null){

      $query = Notice::query();

      if ($campaign) {
         $query->where('campaign_id', $campaign->id);
      } else {
         $query->whereNull('campaign_id');
      }

      $query->where('board_id', $board->id);

      return $query->latest()->get();
   }
}