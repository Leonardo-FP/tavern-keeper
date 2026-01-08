<script setup>
import { ref } from 'vue'; 
import { useAuthStore } from '@/stores/auth';
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/24/solid';
import { RouterLink } from 'vue-router';

const authStore = useAuthStore();

let showMenu = ref(false);
const toggleNav = () => (showMenu.value = !showMenu.value);
const closeNav = () => (showMenu.value = false);
</script>

<template>
  <header class="p-3 bg-santa-fe">
    <div class="container mx-auto flex justify-between items-center text-2xl">
      <nav class="container px-6 mx-auto flex items-center justify-between">
        <h1 class="font-bold">
          <RouterLink to="/" class="text-tavern-logo">
            <span class="line-1">Tavern</span>
            <span class="line-2">Keeper</span>
          </RouterLink>
        </h1>
        <div @click="toggleNav" class="flex">
          <button type="button" aria-label="Abrir menu do usuário" class="focus:outline-none flex cursor-pointer">
            <img
              class="rounded-full bg-black shadow-xl/30 border-1 p-1 w-16 h-16 object-cover"
              :src="authStore?.user?.icon?.path ?? '/assets/icons/avatars/dragon.png'"
              alt="Ícone do usuário"
            />
            <ChevronDownIcon v-if="!showMenu" class="ml-2 w-5" />
            <ChevronUpIcon v-else class="ml-2 w-5" />
          </button>
        </div>
      </nav>

      <ul
        :class="[
          'flex-col ml-auto mt-24 text-right fixed top-0 right-0 left-0 bg-black text-santa-fe w-48 transition-all duration-300',
          showMenu ? 'flex' : 'hidden'
        ]"
      >
        <template v-if="!authStore.isAuthenticated">
          <li><RouterLink @click="closeNav" to="/about" class="px-4 py-2 hover:text-di-serria">Sobre</RouterLink></li>
          <li><RouterLink @click="closeNav" to="/login" class="px-4 py-2 hover:text-di-serria">Login</RouterLink></li>
          <li><RouterLink @click="closeNav" to="/register" class="px-4 py-2 hover:text-di-serria">Registro</RouterLink></li>
        </template>
        <template v-else>
          <li><RouterLink @click="closeNav" to="/" class="px-4 py-2 hover:text-di-serria">Minhas Mesas</RouterLink></li>
          <li><RouterLink @click="closeNav" to="/" class="px-4 py-2 hover:text-di-serria">Meu Perfil</RouterLink></li>
          <li><RouterLink @click="closeNav" to="/" class="px-4 py-2 hover:text-di-serria">Minhas Campanhas</RouterLink></li>
          <li><RouterLink @click="closeNav" to="/" class="px-4 py-2 hover:text-di-serria">Home</RouterLink></li>
          <li><button @click="authStore.logout(); closeNav()" class="px-4 py-2 hover:text-di-serria cursor-pointer">Logout</button></li>
        </template>
      </ul>
    </div>
  </header>
</template>