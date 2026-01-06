<template>
  <div class="w-full">
    <label v-if="label" :for="id" class="block text-lg font-bold mb-1">
      {{ label }}: <span class="text-spice">{{ modelValue }}</span>
    </label>

    <div class="flex items-center gap-4">
      <input 
        type="range" 
        :id="id"
        :value="modelValue"
        :min="min"
        :max="max"
        @input="$emit('update:modelValue', Number($event.target.value))"
        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-spice"
      >

      <input 
        type="number"
        :value="modelValue"
        :min="min"
        :max="max"
        @input="$emit('update:modelValue', Number($event.target.value))"
        class="w-20 border border-gray-300 rounded-md text-center py-1 focus:ring-spice focus:border-spice"
      >
    </div>

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
    modelValue: [Number, String],
    min: { type: Number, default: 1 },
    max: { type: Number, default: 100 }
});

defineEmits(['update:modelValue']);
</script>