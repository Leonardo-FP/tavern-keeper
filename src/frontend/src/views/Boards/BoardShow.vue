<script setup>
    import { useBoardStore } from '@/stores/boardStore'
    import { onBeforeRouteLeave, useRoute } from 'vue-router'
    import { storeToRefs } from 'pinia';
    import { onMounted } from 'vue';
    import AppTable from '@/components/ui/AppTable.vue';

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
    <h2 class="text-tavern-style mb-10">Mesa: {{ current_board?.name }}</h2>
    <div class="grid grid-cols-12 gap-10 mt-4">
        <div class="col-span-7">
            <h3 class="text-tavern-style text-center mb-4">Lista de Campanhas</h3>

            <div class="medieval-frame">
                <div class="medieval-frame-content">
                    <AppTable>
                        <template #body>
                            <tr v-for="campaign in current_board?.campaigns" 
                                :key="campaign.id"
                                class="text-xl"
                            >
                                <td class="text-tavern-style-alt">{{ campaign.name }}</td>
                                <td>
                                    <span 
                                        class="status"
                                        :class="campaign.status?.name?.toLowerCase()"    
                                    >{{ campaign.status?.name ?? '-' }}</span>
                                </td>
                                <td>
                                    <button class="btn-medieval">Abrir</button>
                                </td>
                            </tr>
                        </template>
                    </AppTable>
                </div>
            </div>
        </div>

        <div class="col-span-5">
            <h3 class="text-tavern-style text-center mb-4">Lista de Membros</h3>
            
            <div class="medieval-frame">
                <div class="medieval-frame-content">
                    a
                </div>
            </div>
        </div>

        <div class="col-span-12">
            <h3 class="text-tavern-style text-center mb-4">Mural de Avisos</h3>
            
            <div class="medieval-frame">
                <div class="medieval-frame-content">
                    a
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .medieval-frame {
        padding: 14px;
        background: linear-gradient(
            135deg,
            #4a2e1f,
            #6b422a,
            #3b2418
        );
        border-radius: 10px;
        box-shadow:
            inset 0 0 0 3px #2b160d,
            inset 0 0 0 6px #8a5a3a,
            0 10px 25px rgba(0, 0, 0, 0.5);
    }

    /* Miolo */
    .medieval-frame-content {
        background-color: var(--color-santa-fe);

        padding: 20px;
        border-radius: 6px;

        box-shadow:
            inset 0 0 20px rgba(0, 0, 0, 0.08),
            inset 0 0 4px rgba(0, 0, 0, 0.12);
    }
</style>