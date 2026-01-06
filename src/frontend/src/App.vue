<script setup>
  import Navbar from '@/components/layout/Navbar.vue';
  import ToastContainer from '@/components/layout/ToastContainer.vue';
  import { RouterView } from 'vue-router';
  import { onMounted } from 'vue';
  import { useAuthStore  } from '@/stores/auth';
  
  const authStore = useAuthStore();

  onMounted(() => {
      authStore.loadUser();
  });
</script>

<template>
  <Navbar />

  <main class="container mx-auto p-6">
    <RouterView />
    <ToastContainer />
  </main>
</template>