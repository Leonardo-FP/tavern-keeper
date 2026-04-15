import { defineStore } from 'pinia';
import api from '@/services/api';

export const useStatusStore = defineStore('status', {

    state: () => ({
        statuses: [],
    }),

    actions: {

        async fetchStatuses(type) {
            try {
                const response = await api.get('/statuses', {
                    params: { type }
                });
                
                this.statuses = response.data; 

                return response.data;

            } catch (error) {
                throw error;
            }
        },
    }
});