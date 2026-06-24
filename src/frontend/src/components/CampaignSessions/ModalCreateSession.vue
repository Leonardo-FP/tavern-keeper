<script setup>
import Modal from '@/components/ui/Modal.vue';
import { ref } from 'vue';
import { useModalsStore } from '@/stores/modals';
import { useCampaignStore } from '@/stores/campaignStore';
import { useToastStore } from '@/stores/toast';
import SessionCreateForm from './SessionCreateForm.vue';

const campaignStore = useCampaignStore();
const modalsStore = useModalsStore();
const toastStore = useToastStore();

const sessionCreateFormRef = ref(null);

const props = defineProps({
  campaign: {
    type: Object,
    required: true
  }
});

const emptySession = {
  title: '',
  campaign_id: props.campaign.id
};

const onConfirm = () => {
  sessionCreateFormRef.value.submit();
};

const createSession = async (values) => {

  await campaignStore.createSession(values);
  
  toastStore.addToast({ 
    type: 'success', 
    message: 'Sessão criada com sucesso!' 
  });
  
  modalsStore.closeModal();
};

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'create-session'"
    title="Criar sessão"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <SessionCreateForm
      ref="sessionCreateFormRef"
      :initialValues="emptySession"
      @submit="createSession"
    />
  </Modal>
</template>