import { defineStore } from 'pinia';

export const useToastStore = defineStore('toast', {
  state: () => ({
    toasts: []
  }),
  actions: {
    addToast({ message, type = 'info', duration = 4000 }) {
      const id = Date.now();
      const toast = { id, message, type, duration };
      
      if (this.toasts.length >= 3) {
        this.toasts.shift(); // Remove o mais antigo se passar do limite
      }

      this.toasts.push(toast);

      // Remove automaticamente após o tempo definido
      setTimeout(() => this.removeToast(id), duration);
    },
    removeToast(id) {
      this.toasts = this.toasts.filter(toast => toast.id !== id);
    }
  }
});