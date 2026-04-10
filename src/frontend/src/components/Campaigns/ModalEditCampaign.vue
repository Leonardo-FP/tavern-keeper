<script setup>
import Modal from '@/components/ui/Modal.vue';
import { ref } from 'vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useBoardStore } from '@/stores/boardStore';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const boardStore = useBoardStore();

const props = defineProps({
  initialValues: {
    type: Object,
    required: true
  }
});

console.log(props.initialValues)

</script>

<template>
  <Modal
    :isVisible="modalsStore.activeModal === 'edit-campaign'"
    title="Editar Campanha"
    @close="modalsStore.closeModal()"
  >

  </Modal>
</template>