<script setup>
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import AppInput from '@/components/ui/AppInput.vue'

const props = defineProps({
  initialValues: {
    type: Object,
    required: true
  },
})

const emit = defineEmits(['submit'])

/**
 * Schema
 */
const schema = yup.object({
  title: yup.string().required().min(3),
  campaign_id: yup.number().required(),
})

/**
 * Form
 */
const { handleSubmit, errors, isSubmitting } = useForm({
  validationSchema: schema,
  initialValues: {
    ...props.initialValues
  }
})

/**
 * Fields
 */
const { value: title } = useField('title')
const { value: campaign_id } = useField('campaign_id')

/**
 * Submit
 */
const submit = handleSubmit(values => {

  emit('submit', {
    title: values.title,
    campaign_id: values.campaign_id,
  })
})

defineExpose({
  submit,
  isSubmitting
})

</script>

<template>
  <form class="space-y-6">
    <AppInput v-model="title" label="Título da Sessão" :error="errors.title" />
    <AppInput v-model="campaign_id" type="hidden" />
  </form>
</template>