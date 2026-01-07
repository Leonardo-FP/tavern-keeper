<template>
  <AppCard :link="link">
    <img class="size-12 shrink-0" :src="iconSrc" :alt="iconAlt" />
    <div>
      <div class="text-xl text-left font-bold">{{ title }}</div>
      <p class="text-sm">{{ content }}</p>
    </div>
  </AppCard>
</template>

<script setup>
import AppCard from '@/components/ui/AppCard.vue';
defineProps({
  title: String,
  content: String,
  iconSrc: String,
  iconAlt: String,
  link: String
});
</script>