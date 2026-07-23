import { defineStore } from 'pinia';
import api from '@/services/api';

export const useCampaignSessionStore = defineStore('campaignSessions', {

    state: () => ({
        campaign_session: {},
    }),

    actions: {

        clearCurrentCampaign() {
            this.campaign_session = {}
        },

        async showCampaignSession(campaignId, sessionId) {
            try {
                const response = await api.get(`/campaigns/${campaignId}/sessions/${sessionId}`);
                
                this.campaign_session = {
                    ...response.data
                };
 
                return response.data; 

            } catch (error) {
                throw error;
            }
        },
    }
});