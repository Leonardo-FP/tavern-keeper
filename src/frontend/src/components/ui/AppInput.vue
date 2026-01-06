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
          ? 'border-red-500 focus:ring-red-500 focus:border-red-500' 
          : 'border-gray-300 focus:ring-spice focus:border-spice'
      ]"
      v-bind="$attrs"
    >
    <p v-if="error" class="mt-1 text-sm text-red-600 font-medium italic">
      {{ error }}
    </p>
  </div>
</template>

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