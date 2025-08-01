<script setup>
import { onMounted } from 'vue'; // Apenas onMounted é necessário agora
import { RouterLink, RouterView } from 'vue-router';
import { useAuthStore } from './stores/auth'; // Importe seu store de autenticação

// Instancie o store de autenticação
const authStore = useAuthStore();

onMounted(() => {
  // Configura o interceptor do Axios globalmente APENAS UMA VEZ
  authStore.setupAxiosInterceptor();
  // Tenta carregar os dados do usuário se um token já existe no localStorage
  authStore.loadUser();
});
</script>

<template>
  <header class="p-4 bg-gray-100 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <RouterLink to="/" class="text-2xl font-bold text-gray-800">Tavern Keeper</RouterLink>

      <nav class="flex items-center space-x-4">
        <RouterLink to="/" class="px-4 py-2 text-indigo-600 hover:text-indigo-800 font-semibold">Home</RouterLink>
        <RouterLink to="/about" class="px-4 py-2 text-indigo-600 hover:text-indigo-800 font-semibold">About</RouterLink>

        <template v-if="!authStore.isAuthenticated">
          <RouterLink to="/login" class="px-4 py-2 text-indigo-600 hover:text-indigo-800 font-semibold">Login</RouterLink>
          <RouterLink to="/register" class="px-4 py-2 text-indigo-600 hover:text-indigo-800 font-semibold">Register</RouterLink>
        </template>

        <template v-else>
          <span v-if="authStore.user" class="px-4 py-2 text-gray-700 font-semibold">Olá, {{ authStore.user.name }}</span>
          <button @click="authStore.logout()" class="px-4 py-2 text-red-600 hover:text-red-800 font-semibold">Logout</button>
        </template>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-6">
    <RouterView />
  </main>
</template>