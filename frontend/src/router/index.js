import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import NotFound from '../views/NotFound.vue'
import LoginPage from '../views/Auth/LoginPage.vue'
import RegisterPage from '../views/Auth/RegisterPage.vue'

import { useAuthStore } from '@/stores/auth'; 

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: { requiresAuth: true }
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView,
      meta: { requiresAuth: true }
    },
    {
      path: '/login',
      name: 'login',
      component: LoginPage,
      meta: { requiresGuest: true }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterPage,
      meta: { requiresGuest: true } 
    },
    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: NotFound
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore();

  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const requiresGuest = to.matched.some(record => record.meta.requiresGuest);

  // 1. Redirecionar se a rota requer autenticação e o usuário não está logado
  if (requiresAuth && !authStore.isAuthenticated) {
    next({ name: 'login' }); // Redireciona para a página de login
  }
  // 2. Redirecionar se a rota requer ser convidado (login/registro) e o usuário já está logado
  else if (requiresGuest && authStore.isAuthenticated) {
    next({ name: 'home' }); // Redireciona para a página inicial (ou dashboard)
  }
  // 3. Se nenhuma das condições acima for atendida, permita a navegação
  else {
    next();
  }
});

export default router