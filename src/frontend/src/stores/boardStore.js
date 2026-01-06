import { defineStore } from 'pinia';
import api from '@/services/api';

export const useBoardStore = defineStore('boards', {
    state: () => ({
        boards: [],
    }),

    actions: {
        async createBoard(payload) {
            try {
                const response = await api.post('/boards', payload);
                this.boards.push(response.data);
                
                // Retornamos os dados para que o componente saiba que terminou com sucesso
                return response.data; 
            } catch (error) {
                // Não captura aqui o erro com Toasts.
                // Lança o erro para que o Componente (que tem o formulário) possa decidir o que fazer (ex: setErrors no VeeValidate).
                throw error;
            }
        }
    }
})