<script setup>
import Modal from '@/components/ui/Modal.vue';
import BoardForm from './BoardForm.vue';
import { ref } from 'vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useBoardStore } from '@/stores/boardStore';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const boardStore = useBoardStore();

const boardFormRef = ref(null);

const props = defineProps({
  initialValues: {
    type: Object,
    required: true
  }
});


</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'remove-user-board'"
    title="Remover usuário da mesa"
    :loading="boardFormRef?.isSubmitting"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
   
  </Modal>
</template>