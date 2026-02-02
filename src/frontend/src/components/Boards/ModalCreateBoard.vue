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

const emptyBoard = {
  name: '',
  is_private: false,
  password: '',
  users_limit: 10
};

const onConfirm = () => {
  boardFormRef.value.submit();
};

const createBoard = async (values) => {
  await boardStore.createBoard(values);
  toastStore.addToast({ type: 'success', message: 'Mesa criada! 🎉' });
  modalsStore.closeModal();
};
</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'create-board'"
    title="Criar Mesa de Jogo"
    :loading="boardFormRef?.isSubmitting"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <BoardForm
      ref="boardFormRef"
      :initialValues="emptyBoard"
      @submit="createBoard"
    />
  </Modal>
</template>