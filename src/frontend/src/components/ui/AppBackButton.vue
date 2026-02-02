<script setup>
import { ArrowUturnLeftIcon } from '@heroicons/vue/24/solid';

defineProps({
  route: {
    type: String,
    required: true
  }
});
</script>

<template>
    <RouterLink
        :to="route"
        class="absolute left-4 flex items-center btn-medieval"
    >
    <ArrowUturnLeftIcon class="w-5 mr-1" />
    Voltar
    </RouterLink>
</template>
