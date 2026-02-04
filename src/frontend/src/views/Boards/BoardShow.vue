<script setup>
    import { useBoardStore } from '@/stores/boardStore'
    import { onBeforeRouteLeave, useRoute } from 'vue-router'
    import { storeToRefs } from 'pinia';
    import { computed, onMounted } from 'vue';
    import AppTable from '@/components/ui/AppTable.vue';
    import { Cog6ToothIcon, XMarkIcon } from '@heroicons/vue/24/solid';
    import { useModalsStore } from '@/stores/modals';
    import ModalEditBoard from '@/components/Boards/ModalEditBoard.vue';
    import ModalRemoveUserFromBoard from '@/components/Boards/ModalRemoveUserFromBoard.vue';
    import AppBackButton from '@/components/ui/AppBackButton.vue';

    const boardStore = useBoardStore();
    const modalsStore = useModalsStore();
    const route = useRoute();

    onMounted(() => {
        // Carrega as informações da mesa na boardStore
        boardStore.showBoard(Number(route.params.id));
    });

    // Armazena o valor da mesa atual em uma constante para facilitar o acesso
    const { current_board } = storeToRefs(boardStore);

    // Verifica se existem campanhas nessa mesa
    const hasCampaigns = computed(() => {
        return current_board.value?.campaigns?.length > 0;
    });

    onBeforeRouteLeave((to, from, next) => {
        // se o destino NÃO for uma rota de board
        if (!to.path.startsWith('/boards')) {
            boardStore.clearCurrentBoard()
        }

        next()
    });
</script>

<template>
    <div class="relative flex items-center justify-evenly h-12">
        <AppBackButton route="/my-boards" />

        <h2 class="text-tavern-style">Mesa: {{ current_board?.name }}</h2>

        <button 
            v-if="current_board?.is_logged_user_admin"
            class="absolute right-4 flex items-center btn-medieval" 
            @click="modalsStore.openModal('edit-board')"
        >
            <Cog6ToothIcon class="w-5 mr-1"/> 
            <span>Configurações da Mesa</span>
        </button>
    </div>
    <div class="grid grid-cols-12 gap-10 mt-14">
        <div class="col-span-7">
            <h3 class="text-tavern-style text-center mb-4">Lista de Campanhas</h3>

            <div class="medieval-frame">
                <div class="medieval-frame-content">
                    <AppTable>
                        <template #body>
                            <tr v-if="!hasCampaigns">
                                <td
                                    colspan="3"
                                    class="text-center text-tavern-style-alt text-xl"
                                >
                                    Nenhuma campanha encontrada
                                </td>
                            </tr>

                            <tr
                                v-else
                                v-for="campaign in current_board.campaigns"
                                :key="campaign.id"
                                class="text-xl"
                            >
                                <td class="text-tavern-style-alt">
                                    {{ campaign.name }}
                                </td>

                                <td>
                                    <span
                                        class="status"
                                        :class="campaign.status?.name?.toLowerCase()"
                                        >
                                        {{ campaign.status?.name ?? '-' }}
                                    </span>
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
                      <AppTable>
                        <template #body>
                            <tr v-for="user in current_board?.users" 
                                :key="user.id"
                                class="text-xl"
                            >
                                <td class="text-tavern-style-alt">• {{ user.nickname }}</td>

                                <td>
                                    <button class="btn-medieval" @click="modalsStore.openModal('remove-user-board')">
                                        <XMarkIcon class="w-5 mr-1" />
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </AppTable>
                </div>
            </div>
        </div>

        <div class="col-span-12">
            <h3 class="text-tavern-style text-center mb-4">Mural de Avisos</h3>
            
            <div class="medieval-frame">
                <div class="medieval-frame-content">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="p-8">
        <ModalEditBoard
            v-if="current_board"
            :initialValues="current_board"
        />
    </div>
    <div class="p-8">
        <ModalRemoveUserFromBoard
            v-if="current_board"
            :initialValues="current_board"
        />
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