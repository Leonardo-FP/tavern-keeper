<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useAuthStore } from '@/stores/auth';
import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/24/solid';
import { RouterLink } from 'vue-router';

const authStore = useAuthStore();

const showMenu = ref(false);
const menuRef = ref(null);

const toggleNav = () => (showMenu.value = !showMenu.value);
const closeNav = () => (showMenu.value = false);

// Fecha ao clicar fora
const handleClickOutside = (event) => {
  if (menuRef.value && !menuRef.value.contains(event.target)) {
    closeNav();
  }
};

// Fecha com ESC
const handleEsc = (event) => {
  if (event.key === 'Escape') {
    closeNav();
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
  document.addEventListener('keydown', handleEsc);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
  document.removeEventListener('keydown', handleEsc);
});
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

        <!-- Dropdown container -->
        <div class="relative" ref="menuRef">
          <!-- Botão -->
          <button
            type="button"
            aria-label="Abrir menu do usuário"
            class="focus:outline-none flex items-center cursor-pointer"
            @click="toggleNav"
          >
            <img
              class="rounded-full bg-black shadow-xl/30 border p-1 w-16 h-16 object-cover"
              :src="authStore?.user?.icon?.path ?? '/assets/icons/avatars/dragon.png'"
              alt="Ícone do usuário"
            />

            <!-- Ícones animados -->
            <div class="ml-2 relative w-5 h-5">
              <ChevronDownIcon
                class="absolute transition-all duration-200"
                :class="showMenu ? 'opacity-0 rotate-180' : 'opacity-100 rotate-0'"
              />
              <ChevronUpIcon
                class="absolute transition-all duration-200"
                :class="showMenu ? 'opacity-100 rotate-0' : 'opacity-0 -rotate-180'"
              />
            </div>
          </button>

          <!-- Menu -->
          <ul
            class="absolute right-0 mt-3 flex flex-col text-right text-lg font-bold w-54 bg-santa-fe shadow-lg rounded-lg border overflow-hidden transition-all duration-200 origin-top z-50 menu"
            :class="showMenu
              ? 'opacity-100 scale-100 translate-y-0'
              : 'opacity-0 scale-95 -translate-y-2 pointer-events-none'"
          >
            <template v-if="!authStore.isAuthenticated">
              <li>
                <RouterLink @click="closeNav" to="/about" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Sobre
                </RouterLink>
              </li>
              <li>
                <RouterLink @click="closeNav" to="/login" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Login
                </RouterLink>
              </li>
              <li>
                <RouterLink @click="closeNav" to="/register" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Registro
                </RouterLink>
              </li>
            </template>

            <template v-else>
              <li>
                <RouterLink @click="closeNav" to="/" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Minhas Mesas
                </RouterLink>
              </li>
              <li>
                <RouterLink @click="closeNav" to="/" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Minhas Campanhas
                </RouterLink>
              </li>
              <li>
                <RouterLink @click="closeNav" to="/" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Meu Perfil
                </RouterLink>
              </li>
              <li>
                <RouterLink @click="closeNav" to="/" class="block px-4 py-2 border-b-1 hover:bg-di-serria">
                  Home
                </RouterLink>
              </li>
              <li>
                <button
                  @click="authStore.logout(); closeNav()"
                  class="w-full text-right px-4 py-2 hover:bg-di-serria cursor-pointer"
                >
                  Logout
                </button>
              </li>
            </template>
          </ul>
        </div>
      </nav>
    </div>
  </header>
</template>

<style scoped>
  .menu {
    box-shadow: 4px 4px 0px black;
  }
</style>