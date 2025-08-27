<script setup>
import Modal from '@/components/Modal.vue';
import { ref } from 'vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';

const modalsStore = useModalsStore();
const toastStore = useToastStore();

var boardName = ref('');
var isPrivate = ref(false);
var boardPassword = ref('');
var usersLimit = ref(10);

var errors = ref([]);
var loading = ref(false);

function validateForm() {
  const validationErrors = [];

  if (!boardName.value.trim()) 
    validationErrors.push('O nome da mesa é obrigatório.');
  if (isPrivate.value && boardPassword.value.length < 4)
    validationErrors.push('Senha deve ter pelo menos 4 caracteres.');
  if (usersLimit.value < 1 || usersLimit.value > 1000)
    validationErrors.push('Limite deve ser entre 1 e 1000.');

  return validationErrors;
}

function clearFields(){
    boardName = ref('');
    isPrivate = ref(false);
    boardPassword = ref('');
    usersLimit = ref(10);
    errors = ref([]);
    loading = ref(false);
}

async function submitForm() {
    errors.value = [];
    loading.value = true;

    const validationErrors = validateForm();

    if (validationErrors.length > 0) {
        errors.value = validationErrors;
        loading.value = false;
        toastStore.addToast({
            type: 'error',
            message: 'Erro ao criar a mesa. Verifique os campos.',
            duration: 4000
        });
        return;
    }

    // Simula chamada à API
    await new Promise(resolve => setTimeout(resolve, 1000));

    const payload = {
        boardName: boardName.value,
        isPrivate: isPrivate.value,
        boardPassword: boardPassword.value,
        usersLimit: usersLimit.value,
    };

    console.log('Dados enviados:', payload);

    toastStore.addToast({
        type: 'success',
        message: 'Mesa criada com sucesso! 🎉',
        duration: 5000
    });

    loading.value = false;

    // Fecha modal após 1.5s
    setTimeout(() => {
        modalsStore.closeCreateBoardModal();
        clearFields();
    }, 1500);
}
</script>

<template>
  <Modal
    :isVisible="modalsStore.isCreateBoardModalVisible"
    title="Criar Mesa de Jogo"
    @close="modalsStore.closeCreateBoardModal"
    @confirm="submitForm"
  >
    <!-- ✅ Mensagens de erro -->
    <div v-if="errors.length" class="mb-4 bg-red-100 text-red-700 p-3 rounded-md">
      <ul class="list-disc pl-5">
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>

    <form class="space-y-6">
      <!-- Nome da Mesa -->
      <div>
        <label for="boardName" class="block text-lg font-bold">Nome da Mesa:</label>
        <input
          type="text"
          id="boardName"
          v-model="boardName"
          required
          class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-spice focus:border-spice sm:text-sm"
        >
      </div>

      <!-- Mesa pública ou privada -->
      <div>
        <label class="block text-lg font-bold mb-2">Visibilidade da Mesa:</label>
        <div class="flex gap-4">
          <label class="flex items-center gap-2">
            <input type="radio" :value="false" v-model="isPrivate" />
            Pública
          </label>
          <label class="flex items-center gap-2">
            <input type="radio" :value="true" v-model="isPrivate" />
            Privada
          </label>
        </div>
      </div>

      <!-- Campo de senha (apenas se privada) -->
      <div v-if="isPrivate">
        <label for="boardPassword" class="block text-lg font-bold">Senha da Mesa:</label>
        <input
          type="password"
          id="boardPassword"
          v-model="boardPassword"
          class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-spice focus:border-spice sm:text-sm"
          placeholder="Digite uma senha"
        >
      </div>

      <!-- Limite de usuários -->
      <div>
        <label class="block text-lg font-bold mb-2">Limite de Usuários:</label>
        <div class="flex items-center gap-4">
          <input
            type="range"
            min="1"
            max="1000"
            v-model="usersLimit"
            class="w-full"
          />
          <input
            type="number"
            min="1"
            max="1000"
            v-model.number="usersLimit"
            class="w-20 border rounded-md text-center"
          />
        </div>
      </div>
    </form>

    <!-- ✅ Loading no botão "Salvar" -->
    <template #footer>
      <button class="px-4 py-2 rounded-md bg-black text-white hover:text-flamingo transition-colors duration-300" :disabled="loading">
        <span v-if="loading">Salvando...</span>
        <span v-else>Salvar</span>
      </button>
    </template>
  </Modal>
</template>


