import { defineStore } from 'pinia';
import axios from 'axios';
import router from '../router'; 

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
        const response = await axios.post('http://localhost:8000/api/login', credentials);

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
        await axios.post('http://localhost:8000/api/logout', {});
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
                const response = await axios.get('http://localhost:8000/api/user');
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

    setupAxiosInterceptor() {
        axios.interceptors.request.use(config => {
            const token = this.token; // Pega o token do store
            if (token) {
                config.headers.Authorization = `Bearer ${token}`;
            }
            return config;
        }, error => {
            return Promise.reject(error);
        });

        axios.interceptors.response.use(response => response, error => {
            if (error.response && error.response.status === 401 && this.isLogged) {
                console.warn('401 Unauthorized, token provavelmente inválido ou expirado. Deslogando...');
                this.logout();
            }
            return Promise.reject(error);
        });
    }
  },
});