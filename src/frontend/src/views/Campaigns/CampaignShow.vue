<script setup>
    import AppBackButton from '@/components/ui/AppBackButton.vue';
    import AppTavernFrame from '@/components/ui/AppTavernFrame.vue';
    import { useCampaignStore } from '@/stores/campaignStore';
    import { useStatusStore } from '@/stores/statusStore';
    import { useModalsStore } from '@/stores/modals';
    import { useRoute } from 'vue-router';
    import { storeToRefs } from 'pinia';
    import { ArrowRightStartOnRectangleIcon, Cog6ToothIcon, XMarkIcon } from '@heroicons/vue/24/solid';
    import { computed, onMounted } from 'vue';
    import AppTable from '@/components/ui/AppTable.vue';
    import ModalEditCampaign from '@/components/Campaigns/ModalEditCampaign.vue';
    import ModalLeaveCampaign from '@/components/Campaigns/ModalLeaveCampaign.vue';

    const campaignStore = useCampaignStore();
    const statusStore = useStatusStore();
    const modalsStore = useModalsStore();
    const route = useRoute();

    onMounted(async () => {
        // Carrega as informações da campanha na campaignStore
        campaignStore.showCampaign(Number(route.params.id));

        // Obtém os possíveis status de uma campanha
        statusStore.fetchStatuses('campaign');
    });

    const gmUsers = computed(() => {
        return (current_campaign.value?.users || [])
            .filter(user => user?.role === 'gm');
    });

    const players = computed(() => {
        return (current_campaign.value?.users || [])
            .filter(user => user?.role === 'player');
    });

    // Armazena o valor da campanha atual em uma constante para facilitar o acesso
    const { current_campaign } = storeToRefs(campaignStore);

</script>

<template>
    <div class="text-center">
        <h2 class="text-tavern-style mb-4">Campanha: {{ current_campaign?.name }}</h2>
    </div>
    <div class="relative flex items-center justify-evenly h-22">
        <AppBackButton 
            :route="`/boards/${current_campaign?.board_id}`" 
            text="Voltar para a mesa" 
        />

        <div class="absolute right-4">
       
            <button 
                v-if="current_campaign?.is_logged_user_gm"
                class="flex items-center btn-medieval"
                @click="modalsStore.openModal('edit-campaign')"
            >
                <Cog6ToothIcon class="w-5 mr-1"/> 
                <span>Configurações da Campanha</span>
            </button>

            <button 
                class="flex items-center btn-medieval"
                @click="modalsStore.openModal('leave-campaign')"
            >
                <ArrowRightStartOnRectangleIcon class="w-5 mr-1"/> 
                <span>Sair da Campanha</span>
            </button>
        </div>
    </div>
  
    <div class="grid grid-cols-12 gap-10 mt-14">
        <div class="col-span-7">
            <h3 class="text-tavern-style text-center mb-4">Sessões</h3>

            <AppTavernFrame>
                <AppTable>
                    <template #body>
                         <tr v-if="!current_campaign?.sessions?.length">
                            <td 
                                colspan="2" 
                                class="text-center text-tavern-style-alt text-xl">
                                Nenhuma sessão registrada ainda
                            </td>
                        </tr>

                        <tr 
                            v-else
                            v-for="session in current_campaign?.sessions" 
                            :key="session.id"
                            class="text-xl"
                        >
                            <td class="text-tavern-style-alt">
                                • {{ session.title }}
                            </td>

                            <td>
                                <button class="btn-medieval text-sm">Abrir</button>
                            </td>
                        </tr>
                    </template>
                </AppTable>
            </AppTavernFrame>
        </div>

        <div class="col-span-5">
            <h3 class="text-tavern-style text-center mb-4">Mestres</h3>
            
            <AppTavernFrame>
                <AppTable>
                    <template #body>
                        <tr v-for="user in gmUsers" 
                            :key="user.id"
                            class="text-xl"
                        >
                            <td class="text-tavern-style-alt">• {{ user.nickname }}</td>

                            <td>
                                <button class="btn-medieval">
                                    <XMarkIcon class="w-5 mr-1" />
                                </button>
                            </td>
                        </tr>
                    </template>
                </AppTable>
            </AppTavernFrame>

            <h3 class="text-tavern-style text-center mb-4 mt-4">Jogadores</h3>
            
            <AppTavernFrame>
                <AppTable>
                    <template #body>
                        <tr v-for="user in players"
                            :key="user.id"
                            class="text-xl"
                        >
                            <td class="text-tavern-style-alt">• {{ user.nickname }}</td>

                            <td>
                                <button class="btn-medieval">
                                    <XMarkIcon class="w-5 mr-1" />
                                </button>
                            </td>
                        </tr>
                    </template>
                </AppTable>
            </AppTavernFrame>
        </div>

        <div class="col-span-12">
            <h3 class="text-tavern-style text-center mb-4">Mural de Avisos</h3>
            
            <AppTavernFrame></AppTavernFrame>
        </div>
    </div>
    <div class="p-8">
        <ModalEditCampaign
            v-if="current_campaign && modalsStore.activeModal === 'edit-campaign'"
            :statuses="statusStore.statuses"
        />
    </div>
        <div class="p-8">
        <ModalLeaveCampaign
            v-if="modalsStore.activeModal === 'leave-campaign'"
            :campaign="current_campaign"
            @close="modalsStore.closeModal"
        />
    </div>
</template>