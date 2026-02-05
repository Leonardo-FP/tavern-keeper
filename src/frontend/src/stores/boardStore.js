import { defineStore } from 'pinia';
import api from '@/services/api';

export const useBoardStore = defineStore('boards', {
    state: () => ({
        boards: [],
        current_board: {},
        pagination: {
            current_page: 1,
            last_page: 1
        }
    }),

    actions: {

        clearCurrentBoard() {
            this.current_board = {}
        },
        
        async createBoard(payload) {
            try {
                const response = await api.post('/boards', payload);
                this.boards.push(response.data);
                
                return response.data; 
            } catch (error) {
                throw error;
            }
        },

        async updateBoard(payload) {
            try {
                const response = await api.put(`/boards/${payload.id}`, payload);
                
                const updated = response.data;

                this.current_board = updated;

                return response.data; 
            } catch (error) {
                throw error;
            }
        },

        async fetchMyBoards(page = 1) {
            try {
                const response = await api.get(`/my-boards?page=${page}`);
                
                // O Laravel Paginate coloca os dados dentro de .data
                this.boards = response.data.data; 
                
                // Guarda o estado da paginação
                this.pagination = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page
                };
            } catch (error) {
                throw error;
            }
        },

        async showBoard(id) {
            try {
                const response = await api.get(`/boards/${id}`);
                this.current_board = response.data;

                return response.data; 

            } catch (error) {
                throw error;
            }
        },

        async removeUserFromBoard(userId, boardId) {
            await api.delete(`/boards/${boardId}/users/${userId}`);

            // Filtra a lista, removendo o usuário que foi deletado
            this.current_board.users = this.current_board.users.filter(
                user => user.id !== userId
            );
        },

        async leaveBoard(boardId) {
            try {

                await api.delete(`/boards/${boardId}/leave`);
                
            } catch(error) {
                throw error;
            }
        }
    }
})