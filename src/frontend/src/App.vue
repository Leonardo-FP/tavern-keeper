<script setup>
  import Navbar from '@/components/Navbar.vue';
  import ToastContainer from '@/components/ToastContainer.vue';
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