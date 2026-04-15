<script setup>
import Modal from '@/components/ui/Modal.vue';
import { ref } from 'vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useBoardStore } from '@/stores/boardStore';
import CampaignEditForm from './CampaignEditForm.vue';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const boardStore = useBoardStore();

const campaignEditFormRef = ref(null);

const props = defineProps({
  initialValues: {
    type: Object,
    required: true
  },
  statuses: {
    type: Array,
    required: true
  }
});

const onConfirm = () => {
  campaignEditFormRef.value.submit();
};

const updateCampaign = async (values) => {
  console.log(values);
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
      :initialValues="{
        ...initialValues,
        status_id: initialValues.status?.id
      }"
      :statuses="statuses"
      @submit="updateCampaign"
    />
  </Modal>
</template>