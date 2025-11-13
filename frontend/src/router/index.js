import { createRouter, createWebHistory } from 'vue-router';
import LoginView from '../views/LoginView.vue';
import SettingsView from '../views/SettingsView.vue';
import ReviewsView from '../views/ReviewsView.vue';

const routes = [
  {
    path: '/',
    redirect: '/reviews'
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/settings',
    name: 'settings',
    component: SettingsView,
    meta: { requiresAuth: true }
  },
  {
    path: '/reviews',
    name: 'reviews',
    component: ReviewsView,
    meta: { requiresAuth: true }
  },
  {
    path: '/:pathMatch(.*)*',
    redirect: '/login'
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('auth_token');

  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ name: 'login' });
    return;
  }

  if (to.name === 'login' && isAuthenticated) {
    next({ name: 'settings' });
    return;
  }

  next();
});

export default router;
