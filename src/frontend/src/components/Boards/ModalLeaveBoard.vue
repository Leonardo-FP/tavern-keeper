<script setup>
import Modal from '@/components/ui/Modal.vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useBoardStore } from '@/stores/boardStore';
import router from '@/router';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const boardStore = useBoardStore();

const props = defineProps({
  board: {
    type: Object,
    required: true
  }
});

const onConfirm = async () => {
    try {
        const board_id = props.board.id;

        await boardStore.leaveBoard(board_id);

        boardStore.clearCurrentBoard(); 
        
        toastStore.addToast({ 
            type: 'success', 
            message: 'Você saiu da mesa com sucesso!' 
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
    :isVisible="modalsStore.activeModal === 'leave-board'"
    title="Sair da mesa"
    @close="modalsStore.closeModal()"
    @confirm="onConfirm"
  >
    <p class="text-xl">Você tem certeza que deseja sair da mesa da mesa <span class="text-tavern-style-alt">{{ board?.name }}</span>?</p>
  </Modal>
</template>