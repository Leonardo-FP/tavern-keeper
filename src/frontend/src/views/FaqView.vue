<script setup>
    import AppAccordion from '@/components/ui/AppAccordion.vue';
    import { onMounted, ref } from 'vue';
    import { useFaqStore } from '@/stores/faqStore';
    import AppBackButton from '@/components/ui/AppBackButton.vue';

    const faqStore = useFaqStore();
    const loading = ref(true);

    const loadPage = async (page) => {
        loading.value = true;
        await faqStore.fetchFaqs(page);
        loading.value = false;
        // Scroll para o topo para melhorar a UX ao trocar de página
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    onMounted(() => loadPage(1));
</script>

<template>
    <div class="relative flex items-center justify-center h-12">
        <!-- Botão à esquerda -->
        <AppBackButton route="/" />

        <!-- Título centralizado -->
        <h2 class="text-tavern-style text-center">Dúvidas Frequentes</h2>
    </div>
    <div class="p-4">
        <div v-if="!loading">
            <div class="medieval-frame max-w-4xl mx-auto">
                <div class="medieval-frame-content">
                    <AppAccordion 
                        v-for="faq in faqStore.faqs" :key="faq.id" :faq="faq" 
                    />
                </div>
            </div>
        </div>

        <div class="mt-10 flex justify-center items-center gap-4">
        <button
            @click="loadPage(faqStore.pagination.current_page - 1)"
            :disabled="faqStore.pagination.current_page === 1"
            class="px-4 py-2 bg-black text-white rounded disabled:opacity-30"
        >
            Anterior
        </button>

        <span class="font-bold">
            Página {{ faqStore.pagination.current_page }} de {{ faqStore.pagination.last_page }}
        </span>

        <button 
            @click="loadPage(faqStore.pagination.current_page + 1)"
            :disabled="faqStore.pagination.current_page === faqStore.pagination.last_page"
            class="px-4 py-2 bg-black text-white rounded disabled:opacity-30"
        >
            Próxima
        </button>
        </div>
    </div>
    
</template>