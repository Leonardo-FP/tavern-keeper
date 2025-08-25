<script setup>
  import { ref, onMounted } from 'vue'; 
  import { RouterLink, RouterView } from 'vue-router';
  import { useAuthStore } from './stores/auth'; // Importa seu store de autenticação
  import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/24/solid'

  // Instancia o store de autenticação
  const authStore = useAuthStore();

  onMounted(() => {
    // Tenta carregar os dados do usuário se um token já existe no localStorage
    authStore.loadUser();
  });

  // Controla abertura e fechamento do menu
  let showMenu = ref(false);
  const toggleNav = () => (showMenu.value = !showMenu.value);
</script>

<template>
  <header class="p-4 bg-santa-fe">
    <div class="container mx-auto flex justify-between items-center text-2xl">
      
      <nav class="container px-6 mx-auto">
        <div class="flex items-center justify-between">
            <RouterLink to="/" class="text-4xl font-bold">Tavern Keeper</RouterLink>
            <!-- Mobile menu button -->
            <div @click="toggleNav" class="flex">
              <button type="button" class="focus:outline-none flex cursor-pointer">
                  <img class="rounded-full bg-black shadow-xl/30 border-1 p-1 w-16 h-16 object-cover" :src="authStore?.user?.icon?.path ?? '/assets/icons/avatars/beer.png'" alt="Ícone escolhido pelo usuário para seu perfil">
                  <ChevronDownIcon v-if="!showMenu" class="ml-2 w-5" />
                  <ChevronUpIcon v-else class="ml-2 w-5" />
              </button>
          </div>
        </div>
      </nav>
      <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <ul :class="showMenu ? 'flex' : 'hidden'" class="flex-col ml-auto mt-24 text-right fixed top-0 right-0 left-0 bg-black text-santa-fe w-48">
          <template v-if="!authStore.isAuthenticated">
            <li><RouterLink to="/about" class="px-4 py-2 hover:text-di-serria">About</RouterLink></li>
            <li><RouterLink to="/login" class="px-4 py-2 hover:text-di-serria">Login</RouterLink></li>
            <li><RouterLink to="/register" class="px-4 py-2 hover:text-di-serria">Register</RouterLink></li>
          </template>

          <template v-else>
            <li><RouterLink to="/" class="px-4 py-2 hover:text-di-serria">Minhas Mesas</RouterLink></li>
            <li><RouterLink to="/" class="px-4 py-2 hover:text-di-serria">Meu Perfil</RouterLink></li>
            <li><RouterLink to="/" class="px-4 py-2 hover:text-di-serria">Minhas Campanhas</RouterLink></li>
            <li><RouterLink to="/" class="px-4 py-2 hover:text-di-serria">Home</RouterLink></li>
            <li><button @click="authStore.logout()" class="px-4 py-2 hover:text-di-serria cursor-pointer">Logout</button></li>
          </template>
        </ul>
    </div>
  </header>

  <main class="container mx-auto p-6">
    <RouterView />
  </main>
</template>