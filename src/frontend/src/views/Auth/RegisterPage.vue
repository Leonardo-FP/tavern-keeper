<script setup>
    import { ref } from 'vue';
    import { RouterLink } from 'vue-router';
    import { useAuthStore } from '../../stores/auth';

    const name = ref('');
    const email = ref('');
    const password = ref('');
    const confirmPassword = ref('');

    const authStore = useAuthStore();

    async function handleRegister() {
        await authStore.register({
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirmPassword.value 
        });
    };
</script>

<template>
    <div class="max-w-md mx-auto mt-12 p-6 border border-gray-300 rounded-lg shadow-lg bg-white">
        <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">Registro</h2>
        <form @submit.prevent="handleRegister">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input 
                    type="text"
                    id="name"
                    v-model="name"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                <ul v-if="authStore?.fieldErrors?.name">
                    <li v-for="(msg, index) in authStore?.fieldErrors?.name" :key="index" class="text-red-600 text-sm">
                        {{ msg }}
                    </li>
                </ul>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail:</label>
                <input
                    type="email"
                    id="email"
                    v-model="email"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                <ul v-if="authStore?.fieldErrors?.email">
                    <li v-for="(msg, index) in authStore?.fieldErrors?.email" :key="index" class="text-red-600 text-sm">
                        {{ msg }}
                    </li>
                </ul>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha:</label>
                <input
                    type="password"
                    id="password"
                    v-model="password"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                <ul v-if="authStore?.fieldErrors?.password">
                    <li v-for="(msg, index) in authStore?.fieldErrors?.password" :key="index" class="text-red-600 text-sm">
                        {{ msg }}
                    </li>
                </ul>
            </div>
            <div class="mb-6">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirme a Senha:</label>
                <input
                    type="password"
                    id="confirmPassword"
                    v-model="confirmPassword"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                <ul v-if="authStore?.fieldErrors?.confirmPassword">
                    <li v-for="(msg, index) in authStore?.fieldErrors?.confirmPassword" :key="index" class="text-red-600 text-sm">
                        {{ msg }}
                    </li>
                </ul>
            </div>
            <button
                type="submit"
                :disabled="authStore.isLoading" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                :class="{ 'opacity-50 cursor-not-allowed': authStore.isLoading }"
            >
                {{ authStore.isLoading ? 'Cadastrando...' : 'Cadastrar' }} 
            </button>
            <template v-if="authStore.authError">
                <p v-for="error in authStore.authError.errors" :key="error" class="mt-4 text-center text-red-600 text-sm">
                    {{ error }}
                </p>
            </template>
        </form>
        <p class="mt-6 text-center text-sm text-gray-600">
            Já possui uma conta?
            <RouterLink to="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
                Faça login
            </RouterLink>
        </p>
    </div>
</template>
