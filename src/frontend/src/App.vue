<script setup>
import Navbar from '@/components/layout/Navbar.vue'
import ToastContainer from '@/components/layout/ToastContainer.vue'
import { RouterView, useRoute } from 'vue-router'
import { onMounted, computed } from 'vue'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
const route = useRoute()

onMounted(() => {
  authStore.loadUser()
})

const layoutClass = computed(() => route.meta.layoutClass ?? '')
</script>

<template>
  <Navbar />

  <main :class="layoutClass" id="main">
    <div class="container mx-auto p-6">
      <RouterView />
      <ToastContainer />
    </div>
  </main>
</template>

<style>
  :root {
    --navbar-height: 96px;
  }

  main#main {
    min-height: calc(100vh - var(--navbar-height));
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
  }

  /* Background específico para a home */
  main.home-background {
    background-image: url('/assets/images/backgrounds/home-background.png');
  }

  /* Background específico para as telas de mesa */
  main.board-background {
    background-image: url('/assets/images/backgrounds/board-background.png');
  }
</style>