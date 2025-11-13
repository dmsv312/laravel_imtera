<template>
  <div class="layout">
    <header-bar v-if="isAuthenticated" @logout="handleLogout" />
    <main>
      <router-view @login-success="handleLoginSuccess" />
    </main>
  </div>
</template>

<script setup>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import { useRouter } from 'vue-router';
import HeaderBar from './components/HeaderBar.vue';

const router = useRouter();
const isAuthenticated = ref(false);

function syncAuthState() {
  isAuthenticated.value = !!localStorage.getItem('auth_token');
}

onMounted(() => {
  syncAuthState();
  window.addEventListener('storage', syncAuthState);
});

onBeforeUnmount(() => {
  window.removeEventListener('storage', syncAuthState);
});

function handleLogout() {
  isAuthenticated.value = false;
  router.push({ name: 'login' });
}

function handleLoginSuccess() {
  isAuthenticated.value = true;
  router.push({ name: 'settings' });
}
</script>

<style scoped>
.layout {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
  padding: 2rem 1rem;
}
</style>
