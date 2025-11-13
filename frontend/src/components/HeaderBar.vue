<template>
  <header class="header">
    <div class="brand">Yandex Reviews Dashboard</div>
    <nav>
      <router-link to="/settings">Settings</router-link>
      <router-link to="/reviews">Reviews</router-link>
      <button type="button" @click="logout" class="logout">Logout</button>
    </nav>
  </header>
</template>

<script setup>
import api from '../api/http';

const emit = defineEmits(['logout']);

async function logout() {
  const token = localStorage.getItem('auth_token');
  if (token) {
    try {
      await api.post('/logout');
    } catch (error) {
      console.error('Logout failed', error);
    }
  }
  localStorage.removeItem('auth_token');
  emit('logout');
}
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 2rem;
  background: #1f2937;
  color: #fff;
}

nav {
  display: flex;
  gap: 1rem;
  align-items: center;
}

nav a {
  color: #93c5fd;
}

nav a.router-link-exact-active {
  color: #fff;
  font-weight: 600;
}

.logout {
  border: none;
  background: #ef4444;
  color: #fff;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
}
</style>
