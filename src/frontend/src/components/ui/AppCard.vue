<template>
  <component
    :is="isButton ? 'button' : 'a'"
    :href="isButton ? null : link"
    @click="isButton ? $emit('click') : null"
    class="flex flex-1 items-center gap-x-4 rounded-xl bg-santa-fe p-6 shadow-cards outline outline-black/5 hover:bg-di-serria cursor-pointer transition-all"
  >
    <slot />
  </component>
</template>

<script setup>
defineProps({ link: String, isButton: Boolean });
defineEmits(['click']);
</script>