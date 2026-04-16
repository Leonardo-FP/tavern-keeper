<script setup>
  defineProps({
    label: String, 
    id: String, 
    error: String, 
    modelValue: [String, Number],
    options: Array,
  });
  defineEmits(['update:modelValue']);
</script>

<template>
  <div class="w-full">
    <label v-if="label" :for="id" class="block text-lg font-bold mb-1">{{ label }}</label>
  
    <select 
      :id="id"
      :value="Number(modelValue)" 
      @change="$emit('update:modelValue', Number($event.target.value))"
      class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none transition-all duration-200"
      :class="[
        error 
          ? 'border-flamingo  focus:border-flamingo' 
          : 'border-spice focus:border-di-serria'
      ]"
    >
      <option 
        v-for="option in options" 
        :key="option.id"
        :value="option.id"
      >
        {{ option.name }}
      </option>
    </select>
 
    <p v-if="error" class="mt-1 text-sm text-flamingo font-medium italic">
      {{ error }}
    </p>
  </div>
</template>