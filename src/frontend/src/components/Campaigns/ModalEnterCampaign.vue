<script setup>
import Modal from '@/components/ui/Modal.vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useBoardStore } from '@/stores/boardStore';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const boardStore = useBoardStore();

const props = defineProps({
  campaign: {
    type: Object,
    required: true
  },
  board: {
    type: Object,
    required: true
  }
});

const onConfirm = async () => {
    try {
        const campaign_id = props.campaign.id;

        await boardStore.joinCampaign(campaign_id);
        
        toastStore.addToast({ 
            type: 'success', 
            message: 'Você começou a participar da campanha!' 
        });
        
        modalsStore.closeModal(); 

    } catch (error){

        if(error.response?.status === 403) {
          toastStore.addToast({
              type: 'error', 
              message: 'Erro ao entrar na campanha.'
          });
        }

        modalsStore.closeModal();
    }
};

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'enter-campaign'"
    title="Entrar na campanha"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <p class="text-xl">Você tem certeza que deseja participar da campanha <span class="text-tavern-style-alt">{{ campaign?.name }}</span> da mesa <span class="text-tavern-style-alt">{{ board?.name }}</span>?</p>
  </Modal>
</template>