import { defineStore } from 'pinia';
import api from '@/services/api';

export const useFaqStore = defineStore('faqs', {
    state: () => ({
        faqs: [],
        pagination: {
            current_page: 1,
            last_page: 1
        }
    }),

    actions: {

        async fetchFaqs(page = 1) {
            try {
                const response = await api.get(`/faqs?page=${page}`);
                
                // O Laravel Paginate coloca os dados dentro de .data
                this.faqs = response.data.data; 
                
                // Guarda o estado da paginação
                this.pagination = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                };
            } catch (error) {
                throw error;
            }
        },
    }
})