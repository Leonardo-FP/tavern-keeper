<script setup>
  import { ref, onMounted } from 'vue'; 
  import { RouterLink, RouterView } from 'vue-router';
  import { useAuthStore } from './stores/auth'; // Importa seu store de autenticação

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
  <header class="p-4 bg-santa-fe shadow-md">
    <div class="container mx-auto flex justify-between items-center text-2xl">
      
      <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center">
        <div class="flex items-center justify-between">
            <RouterLink to="/" class="text-4xl font-bold text-black">Tavern Keeper</RouterLink>
            <!-- Mobile menu button -->
            <div @click="toggleNav" class="flex md:hidden">
              <button type="button" class="focus:outline-none">
                  <img class="rounded-full w-10 h-10 object-cover cursor-pointer" :src="authStore?.user?.icon?.path ?? '/assets/icons/avatars/beer.png'" alt="">
              </button>
          </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <ul :class="showMenu ? 'flex' : 'hidden'" class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
          <template v-if="!authStore.isAuthenticated">
            <li><RouterLink to="/about" class="px-4 py-2 text-black hover:text-di-serria">About</RouterLink></li>
            <li><RouterLink to="/login" class="px-4 py-2 text-black hover:text-di-serria">Login</RouterLink></li>
            <li><RouterLink to="/register" class="px-4 py-2 text-black hover:text-di-serria">Register</RouterLink></li>
          </template>

          <template v-else>
            <li><RouterLink to="/" class="px-4 py-2 text-black hover:text-di-serria">Minhas Mesas</RouterLink></li>
            <li><RouterLink to="/" class="px-4 py-2 text-black hover:text-di-serria">Meu Perfil</RouterLink></li>
            <li><RouterLink to="/" class="px-4 py-2 text-black hover:text-di-serria">Minhas Campanhas</RouterLink></li>
            <li><RouterLink to="/" class="px-4 py-2 text-black hover:text-di-serria">Home</RouterLink></li>
            <li><button @click="authStore.logout()" class="px-4 py-2 text-di-serria cursor-pointer">Logout</button></li>
          </template>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-6">
    <RouterView />
  </main>
</template>