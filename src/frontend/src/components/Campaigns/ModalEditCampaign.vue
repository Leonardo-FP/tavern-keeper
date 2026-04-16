<script setup>
import Modal from '@/components/ui/Modal.vue';
import { ref } from 'vue';
import { useCampaignStore } from '@/stores/campaignStore';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import CampaignEditForm from './CampaignEditForm.vue';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const campaignStore = useCampaignStore();

const campaignEditFormRef = ref(null);

const props = defineProps({
  statuses: {
    type: Array,
    required: true
  }
});

const onConfirm = () => {
  campaignEditFormRef.value.submit();
};

const updateCampaign = async (values) => {
  
    await campaignStore.updateCampaign(values);

    toastStore.addToast({
      type: 'success',
      message: 'Campanha atualizada com sucesso!'
    });

    modalsStore.closeModal();
};

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'edit-campaign'"
    title="Editar Campanha"
    :loading="campaignEditFormRef?.isSubmitting"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <CampaignEditForm
      ref="campaignEditFormRef"
      :initialValues="campaignStore.current_campaign"
      :statuses="statuses"
      @submit="updateCampaign"
    />
  </Modal>
</template>