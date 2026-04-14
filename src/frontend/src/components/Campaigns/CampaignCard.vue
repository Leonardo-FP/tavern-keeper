<script setup>
  import AppCard from '@/components/ui/AppCard.vue';
  import { LockOpenIcon, LockClosedIcon, CalendarDaysIcon, UserGroupIcon, ShieldCheckIcon, FireIcon, BookOpenIcon, ClockIcon } from '@heroicons/vue/24/solid';

  defineProps({ campaign: Object });
  defineEmits(['click']);
</script>

<template>
  <AppCard isButton @click="$emit('click', campaign.id)">
    <div class="flex flex-col w-full gap-2">
      <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold italic">{{ campaign.name }}</h3>
        </div>
      <div class="text-sm text-left font-medium text-black/70">
        <p class="flex">
          <CalendarDaysIcon class="w-5 mr-1" />
          <span>Criada em: {{ campaign.created_at }} </span>
        </p>

        <p class="flex">
          <UserGroupIcon class="w-5 mr-1" />
          <span>Jogadores: {{ campaign.current_players }}</span>
        </p>

        <p class="flex">
          <ClockIcon class="w-5 mr-1" />
          <span>Sessões: {{ campaign.total_sessions }} cadastradas</span>
        </p>
        
        <p v-if="campaign.pivot.role == 'gm'" class="flex">
          <ShieldCheckIcon class="w-5 mr-1" />
          <span>Você é mestre</span>
        </p>
        <p v-else class="flex">
          <FireIcon class="w-5 mr-1" />
          <span>Você é jogador</span>
        </p>
      </div>
    </div>
  </AppCard>
</template>