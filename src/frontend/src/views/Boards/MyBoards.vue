<script setup>
import BoardCard from '@/components/Boards/BoardCard.vue';
import { onMounted, ref } from 'vue';
import { useBoardStore } from '@/stores/boardStore';
import router from '@/router';

const boardStore = useBoardStore();
const loading = ref(true);

const loadPage = async (page) => {
  loading.value = true;
  await boardStore.fetchMyBoards(page);
  loading.value = false;
  // Scroll para o topo para melhorar a UX ao trocar de página
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

const openBoard = (id) => {
  router.push(`/boards/${id}`);
}

onMounted(() => loadPage(1));
</script>

<template>
  <h2 class="text-tavern-style text-center">Minhas mesas</h2>
  <div class="p-4">
    <div v-if="!loading" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <BoardCard 
          v-for="board in boardStore.boards" :key="board.id" :board="board" 
          @click="openBoard"  
        />
    </div>

    <div class="mt-10 flex justify-center items-center gap-4">
      <button 
        @click="loadPage(boardStore.pagination.current_page - 1)"
        :disabled="boardStore.pagination.current_page === 1"
        class="px-4 py-2 bg-black text-white rounded disabled:opacity-30"
      >
        Anterior
      </button>

      <span class="font-bold">
        Página {{ boardStore.pagination.current_page }} de {{ boardStore.pagination.last_page }}
      </span>

      <button 
        @click="loadPage(boardStore.pagination.current_page + 1)"
        :disabled="boardStore.pagination.current_page === boardStore.pagination.last_page"
        class="px-4 py-2 bg-black text-white rounded disabled:opacity-30"
      >
        Próxima
      </button>
    </div>
  </div>
</template>