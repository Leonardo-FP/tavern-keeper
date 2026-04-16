<script setup>
  defineProps({
    label: String, 
    id: String, 
    error: String, 
    modelValue: [String, Number],
    type: { type: String, default: 'text' }
  });
  defineEmits(['update:modelValue']);
</script>

<template>
  <div class="w-full">
    <label v-if="label" :for="id" class="block text-lg font-bold mb-1">{{ label }}</label>
    <input
      :id="id"
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none transition-all duration-200"
      :class="[
        error 
          ? 'border-oxblood  focus:border-oxblood' 
          : 'border-spice focus:border-di-serria'
      ]"
      v-bind="$attrs"
    >
    <p v-if="error" class="mt-1 text-sm text-oxblood border-oxblood font-medium italic">
      {{ error }}
    </p>
  </div>
</template>