<script setup>
import { ref, computed } from 'vue'
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import AppInput from '@/components/ui/AppInput.vue'
import AppSelect from '../ui/AppSelect.vue'

const props = defineProps({
  initialValues: {
    type: Object,
    required: true
  },
  statuses: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['submit'])

/**
 * Schema
 */
const schema = yup.object({
  name: yup.string().required().min(3),
  status_id: yup.number().required(),
  board_id: yup.number().required(),
})

/**
 * Form
 */
const { handleSubmit, errors, isSubmitting } = useForm({
  validationSchema: schema,
  initialValues: props.initialValues,
})

/**
 * Fields
 */
const { value: name } = useField('name')
const { value: status_id } = useField('status_id')
const { value: board_id } = useField('board_id')

/**
 * Submit
 */
const submit = handleSubmit(values => {
  emit('submit', values)
});

defineExpose({
  submit,
  isSubmitting
});

</script>

<template>
  <form class="space-y-6">
    <AppInput v-model="name" label="Nome da Campanha" :error="errors.name" />
    <AppSelect v-model="status_id" :options="statuses" label="Status da Campanha" :error="errors.status" />
    <AppInput v-model="board_id" type="hidden" />
  </form>
</template>