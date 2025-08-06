import axios from 'axios';
import { useAuthStore } from '@/stores/auth'; // Importe a store de autenticação

// Cria a instância do Axios
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
});

// Adiciona o interceptor de requisição
api.interceptors.request.use(
  (config) => {
    const authStore = useAuthStore(); // Pega o token da store
    if (authStore.token) {
      config.headers.Authorization = `Bearer ${authStore.token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Adiciona o interceptor de resposta
api.interceptors.response.use(
  (response) => response,
  (error) => {
    const authStore = useAuthStore();
    if (error.response && error.response.status === 401 && authStore.isLoggedIn) {
      console.warn('401 Unauthorized, token provavelmente inválido ou expirado. Deslogando...');
      authStore.logout(); // Use a action de logout da store
    }
    return Promise.reject(error);
  }
);

export default api;