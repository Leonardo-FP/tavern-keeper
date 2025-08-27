<script setup>
    import Card from '@/components/Card.vue';
    import ModalCreateBoard from '@/components/Boards/ModalCreate.vue';
    import { useAuthStore } from '@/stores/auth';
    import { useModalsStore  } from '@/stores/modals'; 

    const authStore = useAuthStore();
    const modalsStore = useModalsStore();
</script>
<template>
    <h1 class="mb-6 text-3xl">Olá <span class="text-flamingo">{{ authStore.user.nickname }}</span>, seja bem vindo(a)!</h1>
    <div class="flex flex-wrap justify-between gap-6 mb-6">
        <Card 
            title="Encontrar Mesas"
            content="Clique para encontrar uma mesa e começar a jogar"
            iconSrc="/assets/icons/cards/d20.png"
            iconAlt="Este é um card que permite aos jogadores entrarem em mesas"
            link="/about"
        />
        <Card
            title="Criar Nova Mesa"
            content="Clique para criar uma nova mesa"
            iconSrc="/assets/icons/cards/new-table.png"
            iconAlt="Ícone para criar mesa"
            :isButton="true"
            @click="modalsStore.openCreateBoardModal"
        />
    </div>
    <div class="flex flex-wrap justify-between gap-6">
        <Card 
            title="Em desenvolvimento"
            content="Clique para acessar o repositório do projeto no Github"
            iconSrc="/assets/icons/cards/github.png"
            iconAlt="Este é um card que permite aos jogadores acessarem o repositório do Github do projeto"
            link="/about"
        />
        <Card 
            title="Sobre o projeto"
            content="Clique para saber mais sobre o Tavern Keeper"
            iconSrc="/assets/icons/cards/info-button.png"
            iconAlt="Este é um card que permite aos jogadores entenderem mais sobre o projeto"
            link="/about"
        />
        <Card 
            title="Comunidade"
            content="Clique para fazer parte da nossa comunidade no Discord"
            iconSrc="/assets/icons/cards/discord.png"
            iconAlt="Este é um card que permite aos jogadores entrarem na comunidade do Discord do projeto"
            link="/about"
        />
        <Card 
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