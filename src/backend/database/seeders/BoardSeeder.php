<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boards = [
            ['name' => 'Caverna do Dragão', 'password' => Hash::make('12345678'), 'is_private' => 1, 'users_limit' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'A Aventura Começa na Taverna', 'password' => NULL, 'is_private' => 0, 'users_limit' => 100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        $board_user = [
            ['board_id' => 1, 'user_id' => 1, 'is_admin' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['board_id' => 2, 'user_id' => 1, 'is_admin' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['board_id' => 1, 'user_id' => 2, 'is_admin' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['board_id' => 1, 'user_id' => 3, 'is_admin' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('boards')->insert($boards);
        DB::table('board_user')->insert($board_user);
    }
}
