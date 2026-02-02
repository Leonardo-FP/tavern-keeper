<script setup>
  import { defineProps, defineEmits } from 'vue';

  const props = defineProps({
    isVisible: { type: Boolean, default: false },
    title: String,
    loading: { type: Boolean, default: false },
  });

  const emit = defineEmits(['close', 'confirm']);

  const closeModal = () => {
    emit('close');
  };

  const onConfirm = () => {
    emit('confirm');
  };
</script>

<template>
  <div v-if="isVisible" class="fixed inset-0 bg-black/75 flex items-center justify-center z-50 p-4" @click.self="closeModal"
  >
    <div class="relative bg-santa-fe rounded-lg shadow-lg w-11/12 max-w-2xl mx-auto max-h-[calc(100vh-4rem)] flex flex-col">
      <!-- Header fixo -->
      <header class="flex justify-between items-center p-4 border-b border-black/10">
        <h2 class="text-3xl font-semibold">{{ title }}</h2>
        <button @click="closeModal" class="text-black hover:text-red-900 focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </header>

      <!-- Conteúdo com scroll -->
      <div class="flex-1 overflow-y-auto p-4 custom-scroll">
        <slot></slot>
      </div>

      <!-- Rodapé fixo -->
      <footer class="flex justify-end gap-4 p-4 border-t border-black/10">
        <button @click="closeModal" class="px-4 py-2 rounded-md bg-flamingo text-white hover:text-black">Cancelar</button>
        <button 
          @click="onConfirm" 
          :disabled="loading"
          class="px-4 py-2 rounded-md bg-black text-white hover:text-flamingo transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <span v-if="loading">Carregando...</span>
          <span v-else>Salvar</span>
        </button>
      </footer>
    </div>
  </div>
</template>

<style scoped>
/* ✅ Scrollbar estilizada */
.custom-scroll::-webkit-scrollbar {
  width: 8px;
}

.custom-scroll::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3);
  border-radius: 4px;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
  background-color: rgba(0, 0, 0, 0.5);
}

.custom-scroll::-webkit-scrollbar-track {
  background-color: transparent;
}
</style>