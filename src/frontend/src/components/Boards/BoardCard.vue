<script setup>
  import AppCard from '@/components/ui/AppCard.vue';
  import { LockOpenIcon, LockClosedIcon, CalendarDaysIcon, UserGroupIcon, ShieldCheckIcon, FireIcon } from '@heroicons/vue/24/solid';

  defineProps({ board: Object });
  defineEmits(['click']);
</script>

<template>
  <AppCard isButton @click="$emit('click', board.id)">
    <div class="flex flex-col w-full gap-2">
      <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold italic">{{ board.name }}</h3>
        </div>
      <div class="text-sm text-left font-medium text-black/70">

        <p v-if="board.is_private" class="flex">
          <LockClosedIcon class="w-5 mr-1" /> 
          <span>Privada</span>
        </p>
        <p v-else class="flex">
          <LockOpenIcon class="w-5 mr-1" /> 
          <span>Pública</span>
        </p>

        <p class="flex">
          <CalendarDaysIcon class="w-5 mr-1" />
          <span>Criada em: {{ board.created_at }} </span>
        </p>

        <p class="flex">
          <UserGroupIcon class="w-5 mr-1" />
          <span>Jogadores: {{ board.current_players }} de no máximo {{ board.users_limit }}</span>
        </p>

        <p v-if="board.pivot.is_admin" class="flex">
          <ShieldCheckIcon class="w-5 mr-1" />
          <span>Você é administrador</span>
        </p>
        <p v-else class="flex">
          <FireIcon class="w-5 mr-1" />
          <span>Você é jogador</span>
        </p>
      </div>
    </div>
  </AppCard>
</template>