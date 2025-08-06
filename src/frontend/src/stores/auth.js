import { defineStore } from 'pinia';
import router from '../router'; 

import api from '@/services/api'; // Importa a instância do Axios configurada para a API do Laravel

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isLogged: !!localStorage.getItem('auth_token'),
    user: JSON.parse(localStorage.getItem('user_data')) || null,
    token: localStorage.getItem('auth_token') || null,
    authError: null,
    isLoading: false,
  }),

  getters: {
    isAuthenticated: (state) => state.isLogged,
    getAuthToken: (state) => state.token,
    getUser: (state) => state.user,
  },

  actions: {
    async login(credentials) {
      this.isLoading = true;
      this.authError = null;
      try {
        const response = await api.post('/login', credentials);

        this.token = response.data.token;
        this.user = response.data.user;
        this.isLogged = true;

        localStorage.setItem('auth_token', this.token);
        localStorage.setItem('user_data', JSON.stringify(this.user));

        router.push('/');
      } catch (error) {
        console.error('Erro no login (Store):', error);
        this.authError = error.response?.data?.message || 'Erro ao fazer login. Verifique suas credenciais.';
        this.isLogged = false;
        this.user = null;
        this.token = null;
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_data');
      } finally {
        this.isLoading = false;
      }
    },

    async logout() {
      this.isLoading = true;
      this.authError = null;
      try {
        await api.post('/logout', {});
      } catch (error) {
        console.error('Erro ao fazer logout no backend (pode ser token expirado ou já inválido):', error);
      } finally {
        this.token = null;
        this.user = null;
        this.isLogged = false;
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user_data');
        this.isLoading = false;
        router.push('/login');
      }
    },

    async loadUser() {
        if (this.token && !this.user) {
            try {
                const response = await api.get('/user');
                this.user = response.data;
                this.isLogged = true;
                localStorage.setItem('user_data', JSON.stringify(this.user));
            } catch (error) {
                console.error('Erro ao carregar dados do usuário:', error);
                this.logout();
            }
        } else if (!this.token) {
            this.isLogged = false;
            this.user = null;
            localStorage.removeItem('user_token');
            localStorage.removeItem('user_data');
        }
    },
  },
});