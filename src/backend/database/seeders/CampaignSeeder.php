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

        $campaign_users = [
            ['campaign_id' => 1, 'user_id' => 1, 'role' => 'gm',     'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 1, 'user_id' => 2, 'role' => 'player', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 1, 'user_id' => 3, 'role' => 'player', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['campaign_id' => 2, 'user_id' => 1, 'role' => 'gm',     'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 2, 'user_id' => 2, 'role' => 'player', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 2, 'user_id' => 3, 'role' => 'player', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        $campaign_sessions = [
            ['campaign_id' => 1, 'title' => 'Capítulo 1: O início de tudo', 'description' => 'Os aventureiros se encontram em uma taverna e recebem uma missão misteriosa.', 'played_at' => Carbon::now()->subDays(14), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 1, 'title' => 'Capítulo 2: Sombras na Floresta', 'description' => 'O grupo é emboscado por criaturas estranhas durante a viagem.', 'played_at' => Carbon::now()->subDays(10), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 1, 'title' => 'Capítulo 3: O Vilarejo Esquecido', 'description' => 'Um vilarejo abandonado revela pistas sobre um mal maior.', 'played_at' => Carbon::now()->subDays(7), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],

            ['campaign_id' => 2, 'title' => 'Sessão 1: O Roubo em Neon City', 'description' => 'Uma equipe é reunida para executar um assalto em uma megacorporação.', 'played_at' => Carbon::now()->subDays(12), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 2, 'title' => 'Sessão 2: Falha no Sistema', 'description' => 'O plano dá errado após uma falha inesperada nos sistemas de segurança.', 'played_at' => Carbon::now()->subDays(8), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['campaign_id' => 2, 'title' => 'Sessão 3: Caçados', 'description' => 'Agora fugitivos, o grupo precisa escapar da perseguição corporativa.', 'played_at' => Carbon::now()->subDays(4), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('campaigns')->insert($campaign);
        DB::table('campaign_user')->insert($campaign_users);
        DB::table('campaign_sessions')->insert($campaign_sessions);
    }
}
