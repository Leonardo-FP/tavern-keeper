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
            ['name' => 'Draft',     'type' => 'campaign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Active',    'type' => 'campaign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'On Hold',   'type' => 'campaign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Completed', 'type' => 'campaign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Abandoned', 'type' => 'campaign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Archived',  'type' => 'campaign', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('statuses')->insert($status);
    }
}
