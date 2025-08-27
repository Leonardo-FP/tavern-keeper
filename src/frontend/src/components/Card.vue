<script setup>
    defineProps({
        title: String,
        content: String,
        iconSrc: String,
        iconAlt: String,
        link: String,
        isButton: {
            type: Boolean,
            default: false
        }
    });

    const emit = defineEmits(['click']);
</script>

<template>
    <component
        :is="isButton ? 'button' : 'a'"
        :href="isButton ? null : link" 
        @click="isButton ? emit('click') : null"
        class="flex flex-1 items-center gap-x-4 rounded-xl bg-santa-fe p-6 shadow-cards outline outline-black/5 hover:bg-di-serria cursor-pointer"
    >
        <img class="size-12 shrink-0" :src="iconSrc" :alt="iconAlt" />
        <div>
            <div class="text-xl text-left font-bold">{{ title }}</div>
            <p class="text-sm">{{ content }}</p>
        </div>
    </component>
</template>