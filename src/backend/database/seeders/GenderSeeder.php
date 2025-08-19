<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['name' => 'Masculino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Feminino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Outro', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Não especificado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Prefiro não dizer', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('genders')->insert($genders);
    }
}