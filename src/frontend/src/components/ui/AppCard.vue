<script setup>
  defineProps({ link: String, isButton: Boolean });
  defineEmits(['click']);
</script>

<template>
  <component
    :is="isButton ? 'button' : 'a'"
    :href="isButton ? null : link"
    @click="isButton ? $emit('click') : null"
    class="flex flex-1 items-center gap-x-4 rounded-xl bg-santa-fe p-6 outline outline-black/5 hover:bg-di-serria cursor-pointer transition-all card-shadow"
  >
    <slot />
  </component>
</template>

<style>
  .card-shadow {
    box-shadow: 4px 4px 0px black;
  }
</style>