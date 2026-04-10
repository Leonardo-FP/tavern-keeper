import { defineStore } from 'pinia';
import api from '@/services/api';

export const useCampaignStore = defineStore('campaigns', {

    state: () => ({
        current_campaign: {},
    }),

    actions: {

        clearCurrentCampaign() {
            this.current_campaign = {}
        },

        async showCampaign(id) {
            try {
                const response = await api.get(`/campaigns/${id}`);
                this.current_campaign = response.data;
   
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