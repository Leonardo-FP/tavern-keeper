<script setup>
import CampaignCard from '@/components/Campaigns/CampaignCard.vue';
import { onMounted, ref } from 'vue';
import { useCampaignStore } from '@/stores/campaignStore';
import router from '@/router';
import AppBackButton from '@/components/ui/AppBackButton.vue';

const campaignStore = useCampaignStore();
const loading = ref(true);

const loadPage = async (page) => {
  loading.value = true;
  await campaignStore.fetchMyCampaigns(page);
  loading.value = false;
  // Scroll para o topo para melhorar a UX ao trocar de página
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

const openCampaign = (id) => {
  router.push(`/campaigns/${id}`);
}

onMounted(() => loadPage(1));
</script>

<template>
  <div class="relative flex items-center justify-center h-12">
  
    <!-- Botão à esquerda -->
    <AppBackButton route="/" />

    <!-- Título centralizado -->
    <h2 class="text-tavern-style text-center">Minhas campanhas</h2>
  </div>
  <div class="p-4">
    <div v-if="!loading" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <CampaignCard 
          v-for="campaign in campaignStore.campaigns" :key="campaign.id" :campaign="campaign" 
          @click="openCampaign"  
        />
    </div>

    <div class="mt-10 flex justify-center items-center gap-4">
      <button 
        @click="loadPage(campaignStore.pagination.current_page - 1)"
        :disabled="campaignStore.pagination.current_page === 1"
        class="px-4 py-2 bg-black text-white rounded disabled:opacity-30"
      >
        Anterior
      </button>

      <span class="font-bold">
        Página {{ campaignStore.pagination.current_page }} de {{ campaignStore.pagination.last_page }}
      </span>

      <button 
        @click="loadPage(campaignStore.pagination.current_page + 1)"
        :disabled="campaignStore.pagination.current_page === campaignStore.pagination.last_page"
        class="px-4 py-2 bg-black text-white rounded disabled:opacity-30"
      >
        Próxima
      </button>
    </div>
  </div>
</template>