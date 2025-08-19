<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $icons = [
            ['name' => 'Bardo', 'path' => 'assets/icons/bard.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ferreiro', 'path' => 'assets/icons/blacksmith.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Arco e flecha', 'path' => 'assets/icons/bow-and-arrow.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Castelo', 'path' => 'assets/icons/castle.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Catapulta', 'path' => 'assets/icons/catapult.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cavaleiro a Cavalo', 'path' => 'assets/icons/cavalier.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Coroa', 'path' => 'assets/icons/crown.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dragão', 'path' => 'assets/icons/dragon.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Executor', 'path' => 'assets/icons/executor.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bandeira', 'path' => 'assets/icons/flag.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ouro', 'path' => 'assets/icons/gold.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cavalo', 'path' => 'assets/icons/horse.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Rei', 'path' => 'assets/icons/king.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cavaleiro', 'path' => 'assets/icons/knight.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Paladino', 'path' => 'assets/icons/paladin.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Camponesa', 'path' => 'assets/icons/peasant.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Princesa', 'path' => 'assets/icons/princess.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cetro', 'path' => 'assets/icons/scepter.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Alvo', 'path' => 'assets/icons/shooting-target.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Espadas', 'path' => 'assets/icons/swords.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Guerreira', 'path' => 'assets/icons/warrior-female.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Componês', 'path' => 'assets/icons/farmer.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mago', 'path' => 'assets/icons/mage.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('icons')->insert($icons);
    }
}