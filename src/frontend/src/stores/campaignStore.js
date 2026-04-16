import { defineStore } from 'pinia';
import api from '@/services/api';

export const useCampaignStore = defineStore('campaigns', {

    state: () => ({
        campaigns: [],
        current_campaign: {},
        pagination: {
            current_page: 1,
            last_page: 1
        }
    }),

    actions: {

        clearCurrentCampaign() {
            this.current_campaign = {}
        },

        async updateCampaign(payload) {
            try {
                const response = await api.put(`/campaigns/${payload.id}`, payload);
                
                this.current_campaign = response.data;

                return response.data; 
            } catch (error) {
                throw error;
            }
        },

        async fetchMyCampaigns(page = 1) {
            try {
                const response = await api.get(`/my-campaigns?page=${page}`);
                
                // O Laravel Paginate coloca os dados dentro de .data
                this.campaigns = response.data.data; 

                // Guarda o estado da paginação
                this.pagination = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                };
            } catch (error) {
                throw error;
            }
        },

        async showCampaign(id) {
            try {
                const response = await api.get(`/campaigns/${id}`);
                
                this.current_campaign = {
                    ...response.data,
                    status_id: response.data.status?.id
                };
 
                return response.data; 

            } catch (error) {
                throw error;
            }
        },

        async leaveCampaign(campaignId) {
            try {

                await api.delete(`/campaigns/${campaignId}/leave`);
                
            } catch(error) {
                throw error;
            }
        },
    }
});