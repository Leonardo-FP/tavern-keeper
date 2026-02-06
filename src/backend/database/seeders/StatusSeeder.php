<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['name' => 'Draft',     'type' => 'campaign', 'status_color' => '#C8B89A', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Active',    'type' => 'campaign', 'status_color' => '#6FAF8E', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'On Hold',   'type' => 'campaign', 'status_color' => '#8C7A6B', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Completed', 'type' => 'campaign', 'status_color' => '#4F3A2D', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Abandoned', 'type' => 'campaign', 'status_color' => '#A63D2D', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Archived',  'type' => 'campaign', 'status_color' => '#5E5E5E', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('statuses')->insert($status);
    }
}
