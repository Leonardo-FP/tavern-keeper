<script setup>
    import HomeCard from '@/components/Home/HomeCard.vue';
    import ModalCreateBoard from '@/components/Boards/ModalCreate.vue';
    import { useAuthStore } from '@/stores/auth';
    import { useModalsStore  } from '@/stores/modals'; 
    import AppTavernSign from '@/components/ui/AppTavernSign.vue';

    const authStore = useAuthStore();
    const modalsStore = useModalsStore();
</script>
<template>
    <AppTavernSign/>

    <h2 class="text-tavern-style mb-6">
        Olá <span class="text-flamingo">{{ authStore.user.nickname }}</span>, seja bem vindo(a)!
    </h2>
    <div class="flex flex-wrap justify-between gap-6 mb-6">
        <HomeCard 
            title="Encontrar Mesas"
            content="Clique para encontrar uma mesa e começar a jogar"
            iconSrc="/assets/icons/cards/search.png"
            iconAlt="Este é um card que permite aos jogadores entrarem em mesas"
            link="/about"
        />
        <HomeCard
            title="Criar Mesa"
            content="Clique para criar uma nova mesa"
            iconSrc="/assets/icons/cards/new-table.png"
            iconAlt="Ícone para criar mesa"
            :isButton="true"
            @click="modalsStore.openCreateBoardModal"
        />
        <HomeCard
            title="Minhas Mesas"
            content="Clique para acessar as mesas que você participa"
            iconSrc="/assets/icons/cards/d20.png"
            iconAlt="Ícone para criar mesa"
            link="/my-boards"
        />
    </div>
    <div class="flex flex-wrap justify-between gap-6">
        <HomeCard 
            title="Em desenvolvimento"
            content="Clique para acessar o repositório do projeto no Github"
            iconSrc="/assets/icons/cards/github.png"
            iconAlt="Este é um card que permite aos jogadores acessarem o repositório do Github do projeto"
            link="/about"
        />
        <HomeCard 
            title="Sobre o projeto"
            content="Clique para saber mais sobre o Tavern Keeper"
            iconSrc="/assets/icons/cards/info-button.png"
            iconAlt="Este é um card que permite aos jogadores entenderem mais sobre o projeto"
            link="/about"
        />
        <HomeCard 
            title="Comunidade"
            content="Clique para fazer parte da nossa comunidade no Discord"
            iconSrc="/assets/icons/cards/discord.png"
            iconAlt="Este é um card que permite aos jogadores entrarem na comunidade do Discord do projeto"
            link="/about"
        />
        <HomeCard 
            title="Dúvidas frequentes"
            content="Clique para tirar as suas dúvidas"
            iconSrc="/assets/icons/cards/question.png"
            iconAlt="Este é um card que permite aos jogadores visualizarem as dúvidas frequentes"
            link="/about"
        />
    </div>
    <div class="p-8">
        <ModalCreateBoard />
    </div>
</template>