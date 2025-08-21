<script setup>
    defineProps({
        link: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        },
        content: {
            type: String,
            required: true
        },
        iconSrc: {
            type: String,
            required: true
        },
        iconAlt: {
            type: String,
            required: true
        }
    });
</script>

<template>
    <a :href="link" class="flex flex-1 items-center gap-x-4 rounded-xl bg-santa-fe p-6 shadow-cards outline outline-black/5 hover:bg-di-serria">
        <img class="size-12 shrink-0" :src="iconSrc" :alt="iconAlt" />
        <div>
            <div class="text-2xl">{{ title }}</div>
            <p class="text-lg">{{ content }}</p>
        </div>
    </a>
</template>

