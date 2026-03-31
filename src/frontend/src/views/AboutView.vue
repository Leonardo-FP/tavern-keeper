<script setup>
import AppBackButton from '@/components/ui/AppBackButton.vue';

</script>

<template>
    <div class="relative flex items-center justify-center h-12">
        <!-- Botão à esquerda -->
        <AppBackButton route="/" />

        <!-- Título centralizado -->
        <h2 class="text-tavern-style text-center">Sobre o projeto</h2>
    </div>
    <div class="p-4">
        <div class="medieval-frame max-w-4xl mx-auto">
            <div class="medieval-frame-content">
                <p>
                    O <strong>Tavern Keeper</strong> nasceu da vontade de tornar as sessões de RPG mais organizadas, imersivas e fáceis de revisitar.
                </p>

                <p>
                    Quem já jogou sabe: histórias incríveis acontecem na mesa… mas muitas delas se perdem com o tempo. Personagens, decisões importantes, momentos épicos — tudo acaba ficando só na memória dos jogadores.
                </p>

                <p>
                    A proposta do Tavern Keeper é resolver isso.
                </p>

                <p>
                    Aqui, mestres e jogadores podem registrar suas sessões, acompanhar o progresso das campanhas e manter viva a história construída em conjunto. Não é sobre substituir a experiência do RPG de mesa, mas sim <strong>potencializá-la</strong>.
                </p>

                <div class="mt-8">
                    <h2 class="text-2xl font-semibold mb-4">👤 Sobre o idealizador</h2>

                    <div class="flex items-center gap-4">
                        <img src="/assets/images/leo.jpg" alt="Foto de Leonardo, idealizador do Tavern Keeper" class="w-18 h-18 rounded-full object-cover border-2"/>

                        <div>
                            <p class="font-semibold">Leonardo</p>
                            <p class="text-sm">Desenvolvedor e entusiasta de RPG, criador do Tavern Keeper.</p>
                            <p class="text-sm">@leonardo-fp</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mt-6 mb-2">🎲 O que você pode fazer</h2>
                    <ul class="list-disc pl-5 space-y-1">
                    <li>Registrar sessões e acontecimentos importantes</li>
                    <li>Organizar campanhas e personagens</li>
                    <li>Consultar rapidamente informações do jogo</li>
                    <li>(Em breve) Integrar conteúdos como monstros, itens e magias</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mt-6 mb-2">🧠 Filosofia do projeto</h2>
                    <p>
                    O Tavern Keeper foi pensado para ser um apoio — não um substituto.
                    </p>
                    <p>
                    Nada de sistemas complexos ou mecânicas engessadas. A ideia é manter o espírito do RPG “raiz”, onde a criatividade e a narrativa são o foco principal.
                    </p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold mt-6 mb-2">🚧 Em desenvolvimento</h2>
                    <p>
                    O projeto ainda está em evolução. Novas funcionalidades estão sendo planejadas e implementadas constantemente.
                    </p>
                    <p>
                    Se quiser acompanhar o progresso ou contribuir, o repositório está disponível no GitHub.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>