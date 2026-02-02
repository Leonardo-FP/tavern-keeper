import { defineStore } from "pinia";
import { ref } from "vue";

export const useModalsStore = defineStore('modals', () => {
    
    const activeModal = ref(null);

    const openModal = (type) => {
        activeModal.value = type;
    }

    const closeModal = () => {
        activeModal.value = null;
    }

    return {
        activeModal, 
        openModal, 
        closeModal,
    };
});