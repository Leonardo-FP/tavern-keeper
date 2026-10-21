
<script setup>
import { computed, ref, watch } from 'vue';

const emit = defineEmits(['send-entry']);

const newEntry = ref('');

const props = defineProps({
    entries: {
        type: Array,
        default: () => [],
    },
    currentUserId: {
        type: [Number, String],
        required: true,
    },
    entrySent: {
        type: Number,
        required: false,
    },
    entryError: {
        type: String,
        required: false,
    }
});

function submitEntry() {
    const content = newEntry.value.trim();

    if(!content) {
        return;
    }

    emit('send-entry', content);
}

watch( 
    () => props.entrySent, 
    () => {
        newEntry.value = '';
    }
);

// Mais recentes primeiro, sem modificar o array original.
const sortedEntries = computed(() => {
    return [...props.entries].sort((a, b) => {
        return new Date(b.created_at) - new Date(a.created_at);
    });
});

function isCurrentUser(entry) {
    return String(entry.user_id) === String(props.currentUserId);
}
</script>


<template>
    <div class="flex h-[50dvh] flex-col rounded-lg border border-amber-900/30 bg-stone-950/40 p-4">

        <!-- Área das mensagens -->
        <div class="min-h-0 flex-1 overflow-y-auto">
            <div
                v-if="sortedEntries.length === 0"
                class="flex h-full items-center justify-center text-stone-400"
            >
                Nenhuma mensagem registrada nesta sessão.
            </div>

            <div v-else class="flex flex-col gap-4">
                <div
                    v-for="entry in sortedEntries"
                    :key="entry.id"
                    class="flex w-full"
                    :class="isCurrentUser(entry) ? 'justify-end' : 'justify-start'"
                >
                    <div
                        class="max-w-[85%] break-words rounded-xl px-4 py-3"
                        :class="isCurrentUser(entry)
                            ? 'border border-amber-400/50 bg-amber-900/40 text-amber-50'
                            : 'border border-stone-700 bg-stone-800 text-stone-200'"
                    >
                        <div
                            class="mb-1 text-xs font-semibold"
                            :class="isCurrentUser(entry)
                                ? 'text-amber-300'
                                : 'text-stone-400'"
                        >
                            {{ entry.user?.nickname ?? 'Usuário' }}
                        </div>

                        <p class="whitespace-pre-wrap">{{ entry.content }}</p>

                        <div class="mt-2 text-right text-xs text-stone-400">
                            {{ new Date(entry.created_at).toLocaleString('pt-BR') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Campo de envio -->
        <form
            class="mt-4 flex shrink-0 items-end gap-3"
            @submit.prevent="submitEntry"
        >
            <textarea
                v-model="newEntry"
                rows="1"
                placeholder="Escreva sua mensagem..."
                maxlength="10000"
                class="min-w-0 flex-1 resize-none rounded-lg border border-stone-700 bg-stone-900 px-4 py-3 text-stone-100 placeholder-stone-500 outline-none focus:border-amber-500"
            ></textarea>

            <button
                type="submit"
                class="shrink-0 rounded-lg bg-amber-700 px-5 py-3 font-semibold text-amber-50 transition hover:bg-amber-600"
            >
                Enviar
            </button>
        </form>
        <p v-if="entryError" class="text-red-600">
            {{ entryError  }}
        </p>

    </div>
</template>