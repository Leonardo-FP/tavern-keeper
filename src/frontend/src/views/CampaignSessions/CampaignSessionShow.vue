<script setup>
    import AppBackButton from '@/components/ui/AppBackButton.vue';
    import AppTavernFrame from '@/components/ui/AppTavernFrame.vue';
    import { useCampaignSessionStore } from '@/stores/campaignSessionStore';
    import { computed, onMounted } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useRoute } from 'vue-router';

    const campaignSessionStore = useCampaignSessionStore();
    const route = useRoute();

    // Armazena o valor da sessão atual em uma constante para facilitar o acesso
    const { campaign_session } = storeToRefs(campaignSessionStore);

    onMounted(async () => {
        const campaignId = Number(route.params.campaignId);
        const sessionId = Number(route.params.sessionId);

        // Carrega as informações da sessão na campaignSessionStore
        await campaignSessionStore.showCampaignSession(campaignId, sessionId);
    });

    const entries = computed(() => campaign_session.value?.entries ?? []);

</script>

<template>
    <div class="text-center">
        <h2 class="text-tavern-style mb-4">Sessão: {{ campaign_session.title }}</h2>
    </div>
    <div class="relative flex items-center justify-end h-22">
        <AppBackButton 
            :route="`/campaigns/${campaign_session.campaign?.id}`" 
            text="Voltar para a tela da campanha" 
        />
    </div>
  
    <div class="grid grid-cols-12 gap-10 mt-14">
        <div class="col-span-12">
            <h3 class="text-tavern-style text-center mb-4">Registros da Sessão</h3>

            <AppTavernFrame>
                <div v-for="entry in campaign_session.entries" :key="entry.id">
                    {{ entry.content }}
                </div>
            </AppTavernFrame>
        </div>
    </div>
</template>