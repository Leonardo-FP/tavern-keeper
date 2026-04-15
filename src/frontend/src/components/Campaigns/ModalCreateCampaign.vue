<script setup>
import Modal from '@/components/ui/Modal.vue';
import { ref } from 'vue';
import { useModalsStore } from '@/stores/modals';
import { useBoardStore } from '@/stores/boardStore';
import { useToastStore } from '@/stores/toast';
import CampaignCreateForm from './CampaignCreateForm.vue';

const boardStore = useBoardStore();
const modalsStore = useModalsStore();
const toastStore = useToastStore();

const campaignCreateFormRef = ref(null);

const props = defineProps({
  board: {
    type: Object,
    required: true
  }
});

const emptyCampaign = {
  name: '',
  board_id: props.board.id
};

const onConfirm = () => {
  campaignCreateFormRef.value.submit();
};

const createCampaign = async (values) => {

  await boardStore.createCampaign(values);
  
  toastStore.addToast({ 
    type: 'success', 
    message: 'Campanha criada com sucesso!' 
  });
  
  modalsStore.closeModal();
};

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'create-campaign'"
    title="Criar campanha"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <CampaignCreateForm
      ref="campaignCreateFormRef"
      :initialValues="emptyCampaign"
      :boardUsers="props.board.users"
      @submit="createCampaign"
    />
  </Modal>
</template>