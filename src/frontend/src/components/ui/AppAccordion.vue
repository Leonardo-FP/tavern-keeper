<script setup>
import { ArrowTurnDownRightIcon, ChevronDownIcon } from '@heroicons/vue/24/solid';
import { ref } from 'vue';

defineProps({
  faq: {
    type: Array,
    required: true
  }
});

const openIndex = ref(null);

function toggle(index) {
  openIndex.value = openIndex.value === index ? null : index;
}
</script>

<template>
  <div class="w-full">
    <div class="border-b border-spice">
      <!-- Header -->
      <button
        class="w-full flex justify-between items-center py-4 text-left"
        @click="toggle(index)"
      >
        <div class="text-lg text-left font-bold">
          {{ faq.question }}
        </div>

        <div
          class="transform transition-transform duration-300"
          :class="{ 'rotate-180': openIndex === index }"
        >
            <ChevronDownIcon class="w-5 mr-1" />
        </div>
      </button>

      <!-- Content -->
      <div
        class="overflow-hidden transition-all duration-300"
        :class="openIndex === index ? 'max-h-96 pb-4' : 'max-h-0'"
      >
        <div class="flex text-sm ml-6">
            <span><ArrowTurnDownRightIcon class="w-5 mr-1" /></span>
            {{ faq.answer }}
        </div>
      </div>
    </div>
  </div>
</template>