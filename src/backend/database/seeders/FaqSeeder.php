<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'O que é o Tavern Keeper?',
                'answer' => 'O Tavern Keeper é uma ferramenta criada para ajudar mestres e jogadores de RPG a organizarem e registrarem suas sessões de forma simples e imersiva',
            ],
            [
                'question' => 'O Tavern Keeper substitui o mestre de jogo?',
                'answer' => 'Não. O objetivo do Tavern Keeper é apoiar o mestre, não substituí-lo. Ele serve como uma ferramenta de organização e registro.',
            ],
            [
                'question' => 'Preciso conhecer Dungeons & Dragons para usar?',
                'answer' => 'Não necessariamente. Apesar de ser inspirado em sistemas como Dungeons & Dragons, o Tavern Keeper pode ser adaptado para outros sistemas de RPG.',
            ],
            [
                'question' => 'Posso registrar minhas sessões de RPG?',
                'answer' => 'Sim! Um dos principais objetivos da plataforma é permitir que você registre sessões, acontecimentos importantes e decisões dos jogadores.',
            ],
            [
                'question' => 'O Tavern Keeper é gratuito?',
                'answer' => 'Atualmente, sim. O projeto está em desenvolvimento e pode evoluir no futuro com novas funcionalidades.',
            ],
            [
                'question' => 'Posso compartilhar minhas campanhas com outros jogadores?',
                'answer' => 'A ideia é permitir o compartilhamento de campanhas e histórias, mas essa funcionalidade pode depender da evolução do projeto.',
            ],
            [
                'question' => 'O sistema possui integração com conteúdos de D&D?',
                'answer' => 'O Tavern Keeper pode integrar dados públicos de D&D, como monstros, magias e itens, dependendo das APIs disponíveis.',
            ],
            [
                'question' => 'Posso acessar o projeto pelo GitHub?',
                'answer' => 'Sim, o projeto está disponível publicamente no GitHub para acompanhamento e contribuições.',
            ],
        ];

        $data = [];

        foreach ($faqs as $index => $faq) {
            $data[] = [
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('faqs')->insert($data);
    }
}
