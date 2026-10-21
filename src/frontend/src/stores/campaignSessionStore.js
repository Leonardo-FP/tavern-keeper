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

        async createEntry(campaignId, sessionId, content) {
            const response = await api.post(
                `/campaigns/${campaignId}/sessions/${sessionId}/entries`,
                { content }
            );

            if (!this.campaign_session.entries) {
                this.campaign_session.entries = [];
            }

            this.campaign_session.entries.push(response.data);

            return response.data;
        }
    }
});