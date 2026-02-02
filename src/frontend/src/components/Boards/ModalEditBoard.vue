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

const onConfirm = () => {
  boardFormRef.value.submit();
};

const updateBoard = async (values) => {
  await boardStore.updateBoard(values);
  toastStore.addToast({ type: 'success', message: 'Mesa editada! 🎉' });
  modalsStore.closeModal();
};
</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'edit-board'"
    title="Editar Mesa de Jogo"
    :loading="boardFormRef?.isSubmitting"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <BoardForm
      ref="boardFormRef"
      :initialValues="props.initialValues"
      @submit="updateBoard"
    />
  </Modal>
</template>