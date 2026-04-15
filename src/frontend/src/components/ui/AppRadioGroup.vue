<script setup>
  defineProps({
    label: String,
    id: String,    
    error: String,
    modelValue: [String, Number, Boolean], 
    options: {
      type: Array,
      required: true 
    }
  });
  defineEmits(['update:modelValue']);
</script>

<template>
  <div class="w-full">
    <label v-if="label" :for="id" class="block text-lg font-bold mb-1">{{ label }}</label>
    
    <div class="flex gap-4">
      <label 
        v-for="option in options" :key="option.value" 
        class="flex items-center gap-2 cursor-pointer"
      >
        <input
          type="radio"
          :name="id" 
          :value="option.value"
          :checked="modelValue === option.value"
          @change="$emit('update:modelValue', option.value)"
          class="w-4 h-4 accent-spice"
        >
        <span>{{ option.label }}</span>
      </label>
    </div>

    <p v-if="error" class="mt-1 text-sm text-red-600 font-medium italic">
      {{ error }}
    </p>
  </div>
</template>