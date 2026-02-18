<script setup>
import { computed } from 'vue'
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import AppInput from '@/components/ui/AppInput.vue'

const props = defineProps({
  initialValues: {
    type: Object,
    required: true
  },
  boardUsers: {
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
  board_id: yup.number().required(),
  players: yup.array().of(yup.number()),
  gms: yup.array().of(yup.number())
})

/**
 * Form
 */
const { handleSubmit, errors, isSubmitting } = useForm({
  validationSchema: schema,
  initialValues: {
    ...props.initialValues,
    players: [],
    gms: []
  }
})

/**
 * Fields
 */
const { value: name } = useField('name')
const { value: board_id } = useField('board_id')
const availableUsers = computed(() => {
  return props.boardUsers.filter(user =>
    !players.value.includes(user.id) &&
    !gms.value.includes(user.id)
  )
})

/**
 * Submit
 */
const submit = handleSubmit(values => {
  const campaign_users = [
    ...values.players.map(id => ({
      user_id: id,
      role: 'player'
    })),
    ...values.gms.map(id => ({
      user_id: id,
      role: 'gm'
    }))
  ]

  emit('submit', {
    name: values.name,
    board_id: values.board_id,
    campaign_users
  })
})

defineExpose({
  submit,
  isSubmitting
})

function addPlayer(userId) {
  players.value.push(userId)
  showPlayerSelect.value = false
}

function removePlayer(userId) {
  players.value = players.value.filter(id => id !== userId)
}
</script>

<template>
  <form class="space-y-6">
    <AppInput v-model="name" label="Nome da Campanha" :error="errors.name" />
    <AppInput v-model="board_id" type="hidden" />

    <div class="grid grid-cols-2 gap-4">
        <div class="justify-items-center">
            <h3>Jogadores</h3>

            <div v-for="id in players" :key="id" @click="removePlayer(id)">
                {{ usersMap[id]?.name }}
            </div>

            <button @click="showPlayerSelect = true">
                + Adicionar usuário
            </button>

            <select v-if="showPlayerSelect"
                @change="addPlayer(Number($event.target.value))">
                <option disabled selected value="">Selecione</option>

                <option
                    v-for="user in availableUsers"
                    :key="user.id"
                    :value="user.id"
                >
                    {{ user.name }}
                </option>
            </select>
        </div>

        <div class="justify-items-center">
            <h3>Mestres</h3>

            <div v-for="id in players" :key="id" @click="removePlayer(id)">
                {{ usersMap[id]?.name }}
            </div>

            <button @click="showPlayerSelect = true">
                + Adicionar usuário
            </button>

            <select v-if="showPlayerSelect"
                @change="addPlayer(Number($event.target.value))">
                <option disabled selected value="">Selecione</option>

                <option
                    v-for="user in availableUsers"
                    :key="user.id"
                    :value="user.id"
                >
                    {{ user.name }}
                </option>
            </select>
        </div>
    </div>
  </form>
</template>