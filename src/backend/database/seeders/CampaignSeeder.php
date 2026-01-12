<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaign = [
            ['name' => 'The Ashes of the Fallen Crown', 'board_id' => '1', 'status_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Whispers Beneath the Iron Moon', 'board_id' => '1', 'status_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'The Last Lantern of Eldermere', 'board_id' => '1', 'status_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Echoes of a Broken Pact', 'board_id' => '1', 'status_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'The Crimson Road to Blackspire', 'board_id' => '2', 'status_id' => '4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Songs of Stone and Shadow', 'board_id' => '2', 'status_id' => '5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('campaigns')->insert($campaign);
    }
}
