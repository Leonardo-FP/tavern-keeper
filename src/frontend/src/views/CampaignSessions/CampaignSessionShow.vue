<script setup>
    import AppBackButton from '@/components/ui/AppBackButton.vue';
    import AppTavernFrame from '@/components/ui/AppTavernFrame.vue';
    import AppChat from '@/components/ui/AppChat.vue';
    import { useCampaignSessionStore } from '@/stores/campaignSessionStore';
    import { useAuthStore } from '@/stores/auth';
    import { computed, onMounted, ref } from 'vue';
    import { storeToRefs } from 'pinia';
    import { useRoute } from 'vue-router';

    const campaignSessionStore = useCampaignSessionStore();
    const route = useRoute();
    const authStore = useAuthStore();

    // Armazena o valor da sessão atual em uma constante para facilitar o acesso
    const { campaign_session } = storeToRefs(campaignSessionStore);

    onMounted(async () => {
        const campaignId = Number(route.params.campaignId);
        const sessionId = Number(route.params.sessionId);

        // Carrega as informações da sessão na campaignSessionStore
        await campaignSessionStore.showCampaignSession(campaignId, sessionId);
    });

    const entries = computed(() => campaign_session.value.entries ?? []);

    const entrySent = ref(0);
    const entryError = ref('');

    async function handleSendEntry(content) {
        const campaignId = Number(route.params.campaignId);
        const sessionId = Number(route.params.sessionId);

        try {
            entryError.value = '';

            await campaignSessionStore.createEntry(
                campaignId, 
                sessionId, 
                content
            );

            ++entrySent.value; 
        } catch(error) {

            entryError.value = 
                error.response?.data?.errors?.content?.[0] 
                ?? 'Houve um erro ao enviar sua mensagem';
        }
    }

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
                <AppChat
                    :entries="entries"
                    :current-user-id="authStore.user?.id"
                    :entrySent="entrySent"
                    :entryError="entryError"
                    @send-entry="handleSendEntry"
                />
            </AppTavernFrame>
        </div>
    </div>
</template>