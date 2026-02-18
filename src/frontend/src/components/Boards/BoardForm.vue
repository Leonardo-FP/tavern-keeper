<script setup>
  import { useForm, useField } from 'vee-validate';
  import * as yup from 'yup';
  import AppInput from '@/components/ui/AppInput.vue';
  import AppRadioGroup from '@/components/ui/AppRadioGroup.vue';
  import AppRange from '@/components/ui/AppRange.vue';

  const props = defineProps({
    initialValues: {
      type: Object,
      required: true
    }
  });

  const emit = defineEmits(['submit']);

  // 1. Schema
  const schema = yup.object({
    name: yup.string().required().min(3),
    is_private: yup.boolean(),

    password: yup.string().when('is_private', {
      is: true,
      then: s =>
        s
          .nullable()
          .transform(v => (v === '' ? null : v))
          .min(6, 'Mínimo 6 caracteres'),
      otherwise: s => s.nullable()
    }),

    users_limit: yup.number().min(1).max(100).required()
  });

  // 2. Form
  const { handleSubmit, errors, isSubmitting } = useForm({
    validationSchema: schema,
    initialValues: props.initialValues
  });

  // 3. Fields
  const { value: name } = useField('name');
  const { value: is_private } = useField('is_private');
  const { value: password } = useField('password');
  const { value: users_limit } = useField('users_limit');

  // 4. Submit exposto
  const submit = handleSubmit(values => {
    emit('submit', values);
  });

  defineExpose({
    submit,
    isSubmitting
  });
</script>

<template>
  <form class="space-y-6">
    <AppInput v-model="name" label="Nome da Mesa" :error="errors.name" />
    <AppRadioGroup
      v-model="is_private"
      label="Visibilidade"
      :options="[
        { label: 'Pública', value: false },
        { label: 'Privada', value: true }
      ]"
    />
    <AppInput
      v-if="is_private"
      v-model="password"
      type="password"
      label="Senha"
      :error="errors.password"
    />
    <AppRange
      v-model="users_limit"
      label="Limite de Jogadores"
      :error="errors.users_limit"
    />
  </form>
</template>