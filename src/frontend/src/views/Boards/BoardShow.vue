<script setup>
    import { useBoardStore } from '@/stores/boardStore'
    import { onBeforeRouteLeave, useRoute } from 'vue-router'
    import { storeToRefs } from 'pinia';
    import { onMounted } from 'vue';

    const boardStore = useBoardStore();
    const route = useRoute();

    onMounted(() => {
        // Carrega as informações da mesa na boardStore
        boardStore.showBoard(Number(route.params.id));
    });

    // Armazena o valor da mesa atual em uma constante para facilitar o acesso
    const { current_board } = storeToRefs(boardStore);
    
    onBeforeRouteLeave((to, from, next) => {
        // se o destino NÃO for uma rota de board
        if (!to.path.startsWith('/boards')) {
            boardStore.clearCurrentBoard()
        }

        next()
    });
</script>

<template>
    <h2>{{ current_board?.name }}</h2>

</template>