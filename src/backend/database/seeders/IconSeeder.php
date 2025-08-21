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
            ['name' => 'Bardo', 'path' => 'assets/icons/avatars/bard.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ferreiro', 'path' => 'assets/icons/avatars/blacksmith.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Arco e flecha', 'path' => 'assets/icons/avatars/bow-and-arrow.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Castelo', 'path' => 'assets/icons/avatars/castle.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Catapulta', 'path' => 'assets/icons/avatars/catapult.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cavaleiro a Cavalo', 'path' => 'assets/icons/avatars/cavalier.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Coroa', 'path' => 'assets/icons/avatars/crown.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dragão', 'path' => 'assets/icons/avatars/dragon.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Executor', 'path' => 'assets/icons/avatars/executor.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bandeira', 'path' => 'assets/icons/avatars/flag.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ouro', 'path' => 'assets/icons/avatars/gold.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cavalo', 'path' => 'assets/icons/avatars/horse.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Rei', 'path' => 'assets/icons/avatars/king.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cavaleiro', 'path' => 'assets/icons/avatars/knight.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Paladino', 'path' => 'assets/icons/avatars/paladin.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Camponesa', 'path' => 'assets/icons/avatars/peasant.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Princesa', 'path' => 'assets/icons/avatars/princess.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Cetro', 'path' => 'assets/icons/avatars/scepter.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Alvo', 'path' => 'assets/icons/avatars/shooting-target.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Espadas', 'path' => 'assets/icons/avatars/swords.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Guerreira', 'path' => 'assets/icons/avatars/warrior-female.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Componês', 'path' => 'assets/icons/avatars/farmer.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Mago', 'path' => 'assets/icons/avatars/mage.png', 'type' => 'png', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('icons')->insert($icons);
    }
}