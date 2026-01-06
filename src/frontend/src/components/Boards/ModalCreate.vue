<script setup>
import { useForm, useField } from 'vee-validate';
import * as yup from 'yup';
import Modal from '@/components/ui/Modal.vue';
import AppInput from '@/components/ui/AppInput.vue';
import AppRadioGroup from '@/components/ui/AppRadioGroup.vue';
import AppRange from '@/components/ui/AppRange.vue';
import { useModalsStore } from '@/stores/modals';
import { useToastStore } from '@/stores/toast';
import { useBoardStore } from '@/stores/boardStore';

const modalsStore = useModalsStore();
const toastStore = useToastStore();
const boardStore = useBoardStore();

// 1. Definição das Regras com Yup
const schema = yup.object({
  name: yup.string().required('O nome da mesa é obrigatório').min(3, 'Mínimo 3 caracteres'),
  is_private: yup.boolean(),
  password: yup.string().when('is_private', {
    is: true,
    then: (s) => s.required('Mesas privadas exigem senha').min(6, 'Mínimo 6 caracteres'),
    otherwise: (s) => s.nullable()
  }),
  users_limit: yup.number().min(1, 'Mínimo 1').max(100, 'Máximo 100').required('Defina um limite')
});

// 2. Configuração do Formulário
const { handleSubmit, errors, resetForm, isSubmitting, setErrors } = useForm({
  validationSchema: schema, // Insere as regras do formulário, definidas acima pelo Yup
  initialValues: {
    name: '',
    is_private: false,
    password: '',
    users_limit: 10
  }
});

// 3. Mapeamento Reativo para o Template usando useField, garantindo que o VeeValidate saberá quando o usuário digitou algo
const { value: name } = useField('name');
const { value: is_private } = useField('is_private');
const { value: password } = useField('password');
const { value: users_limit } = useField('users_limit');

// 4. Submissão Centralizada
const onSubmit = handleSubmit(async (values) => {
  try {
    // 1. Tenta criar
    await boardStore.createBoard(values);
    
    // 2. Só chega aqui se a API retornou 200/201
    toastStore.addToast({ type: 'success', message: 'Mesa criada! 🎉' });
    
    // 3. Trava o estado isSubmitting por 1 segundo
    await new Promise(resolve => setTimeout(resolve, 1000));

    // 4. Fecha o Modal
    modalsStore.closeCreateBoardModal();

    // 5. Reseta os campos do formulário
    resetForm();
  } catch (error) {
    if (error.response?.status === 422) {
      setErrors(error.response.data.errors);
      toastStore.addToast({ type: 'error', message: 'Verifique os campos.' });
    }
  }
});
</script>

<template>
  <Modal
    :isVisible="modalsStore.isCreateBoardModalVisible"
    title="Criar Mesa de Jogo"
    :loading="isSubmitting"
    @close="modalsStore.closeCreateBoardModal"
    @confirm="onSubmit"
  >
    <form @submit.prevent="onSubmit" class="space-y-6">
      <AppInput 
        v-model="name"
        label="Nome da Mesa:"
        id="name"
        :error="errors.name"
      />

      <AppRadioGroup 
        v-model="is_private"
        label="Visibilidade:"
        :options="[
          { label: 'Pública', value: false },
          { label: 'Privada', value: true }
        ]"
        :error="errors.is_private"
      />

      <AppInput 
        v-if="is_private"
          v-model="password"
          type="password"
          label="Senha da Mesa:"
          id="password"
          :error="errors.password"
      />

      <AppRange 
        v-model="users_limit"
        label="Limite de Jogadores"
        :error="errors.users_limit"
      />
    </form>
  </Modal>
</template>