<script setup>
    import { useToastStore } from '@/stores/toast';
    import { CheckCircleIcon, ExclamationCircleIcon, InformationCircleIcon, XMarkIcon } from '@heroicons/vue/24/solid';

    const toastStore = useToastStore();

    // Mapeamento de estilos e ícones por tipo
    const toastConfig = {
        success: { color: 'bg-green-500', icon: CheckCircleIcon },
        error: { color: 'bg-red-500', icon: ExclamationCircleIcon },
        info: { color: 'bg-blue-500', icon: InformationCircleIcon },
        warning: { color: 'bg-yellow-500', icon: ExclamationCircleIcon }
    };
</script>

<template>
  <div class="fixed top-4 right-4 space-y-3 z-50 w-80">
    <transition-group name="toast" tag="div">
      <div
        v-for="toast in toastStore.toasts"
            :key="toast.id"
            class="relative flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg text-white overflow-hidden"
            :class="toastConfig[toast.type]?.color"
        >

        <!-- Ícone -->
        <component :is="toastConfig[toast.type]?.icon" class="w-6 h-6 flex-shrink-0" />

        <!-- Mensagem -->
        <div class="flex-1 text-sm font-medium">
          {{ toast.message }}
        </div>

        <!-- Botão fechar -->
        <button @click="toastStore.removeToast(toast.id)" class="hover:text-black transition">
          <XMarkIcon class="w-5 h-5" />
        </button>

        <!-- Barra de progresso -->
        <div class="absolute bottom-0 left-0 h-1 bg-black/30 progress-bar" :style="{ animationDuration: toast.duration + 'ms' }"></div>

      </div>
    </transition-group>
  </div>
</template>

<style scoped>
.toast-enter-active,.toast-leave-active {
  transition: all 0.3s ease;
}
.toast-enter-from {
  opacity: 0;
  transform: translateX(100%);
}
.toast-enter-to {
  opacity: 1;
  transform: translateX(0);
}
.toast-leave-from {
  opacity: 1;
  transform: translateX(0);
}
.toast-leave-to {
  opacity: 0;
  transform: translateX(100%);
}

.progress-bar {
  width: 100%;
  animation-name: progress;
  animation-timing-function: linear;
  animation-fill-mode: forwards;
}

@keyframes progress {
  from {
    width: 100%;
  }
  to {
    width: 0%;
  }
}
</style>
