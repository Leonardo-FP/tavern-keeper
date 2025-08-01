<script setup>
import { ref } from 'vue';
import { RouterLink } from 'vue-router'; 
import { useAuthStore } from '../../stores/auth'; 

const email = ref('');
const password = ref('');

const authStore = useAuthStore();

async function handleLogin() {
  await authStore.login({
    email: email.value,
    password: password.value
  });
}
</script>

<template>
  <div class="max-w-md mx-auto mt-12 p-6 border border-gray-300 rounded-lg shadow-lg bg-white">
    <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Login</h2>
    <form @submit.prevent="handleLogin">
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail:</label>
        <input
          type="email"
          id="email"
          v-model="email"
          required
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
      </div>
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha:</label>
        <input
          type="password"
          id="password"
          v-model="password"
          required
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        >
      </div>
      <button
        type="submit"
        :disabled="authStore.isLoading" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        :class="{ 'opacity-50 cursor-not-allowed': authStore.isLoading }"
      >
        {{ authStore.isLoading ? 'Entrando...' : 'Entrar' }} </button>
      <p v-if="authStore.authError" class="mt-4 text-center text-red-600 text-sm">{{ authStore.authError }}</p> </form>
    <p class="mt-6 text-center text-sm text-gray-600">
      Não tem conta?
      <RouterLink to="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
        Cadastre-se
      </RouterLink>
    </p>
  </div>
</template>