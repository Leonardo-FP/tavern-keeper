<script setup>
import Modal from '@/components/ui/Modal.vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useCampaignStore } from '@/stores/campaignStore';
import router from '@/router';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const campaignStore = useCampaignStore();

const props = defineProps({
  campaign: {
    type: Object,
    required: true
  }
});

const onConfirm = async () => {
    try {
        const campaign_id = props.campaign.id;

        console.log(campaign_id);
        await campaignStore.leaveCampaign(campaign_id);

        campaignStore.clearCurrentCampaign(); 
        
        toastStore.addToast({ 
            type: 'success', 
            message: 'Você saiu da campanha!' 
        });
        
        modalsStore.closeModal(); 
        router.push('/my-boards');

    } catch (error){

        modalsStore.closeModal();
    }
};

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'leave-campaign'"
    title="Sair da campanha"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <p class="text-xl">Você tem certeza que deseja sair da campanha <span class="text-tavern-style-alt">{{ campaign?.name }}</span>?</p>
  </Modal>
</template>