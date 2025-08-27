import { defineStore } from "pinia";
import { ref } from "vue";

export const useModalsStore = defineStore('modals', () => {
    const isCreateBoardModalVisible = ref(false);

    const openCreateBoardModal = () => {
        isCreateBoardModalVisible.value = true;
    };

    const closeCreateBoardModal = () => {
        isCreateBoardModalVisible.value = false;
    };

    return {
        isCreateBoardModalVisible,
        openCreateBoardModal,
        closeCreateBoardModal,
    };
});