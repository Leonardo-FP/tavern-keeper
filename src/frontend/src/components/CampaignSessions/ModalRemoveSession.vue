<script setup>
import Modal from '@/components/ui/Modal.vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useCampaignStore } from '@/stores/campaignStore';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const campaignStore = useCampaignStore();

const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  campaign: {
    type: Object,
    required: true
  },
  session: {
    type: Object,
    required: true
  }
});

const onConfirm = async () => {
    try {
        const user_id = props.user.id;
        const campaign_id = props.campaign.id;
        const session_id = props.session.id;

        await campaignStore.removeCampaignSession(campaign_id, session_id);
        
        toastStore.addToast({ 
            type: 'success', 
            message: 'Sessão deletada com sucesso!' 
        });
        
        modalsStore.closeModal(); 

    } catch (error){

        if(error.response?.status === 403) {
          toastStore.addToast({
              type: 'error', 
              message: 'Você não tem permissão para editar esta campanha.'
          });
        }

        modalsStore.closeModal();
    }
};

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'remove-campaign-session'"
    title="Aviso de Exclusão"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <p class="text-2xl text-center text-tavern-style-alt mt-2 mb-3">
        Você tem certeza que deseja remover esta sessão?
    </p>

    <div class="bg-black/10 border border-oxblood/35 rounded-md p-4 my-2 max-w-lg mx-auto">
        <div class="text-xl uppercase text-tavern-style-alt mb-2">Sessão:</div>
        <div class="mb-2 break-words">
            {{ session?.title }}
        </div>
        
        <div class="text-xl uppercase text-tavern-style-alt mb-2">Campanha:</div>
        <div class="break-words">
            {{ campaign?.name }}
        </div>
    </div>

    <p class="text-sm text-oxblood font-medium italic">
        * Esta ação é irreversível e os dados serão perdidos <strong>permanentemente</strong>.
    </p>
  </Modal>
</template>