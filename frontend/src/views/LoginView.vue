<template>
  <section class="container">
    <h1>Sign in</h1>
    <form @submit.prevent="handleSubmit" class="card">
      <label>
        Email
        <input type="email" v-model="form.email" required />
      </label>
      <label>
        Password
        <input type="password" v-model="form.password" required />
      </label>
      <button type="submit" :disabled="loading">
        {{ loading ? 'Signing in...' : 'Login' }}
      </button>
      <p v-if="error" class="error">{{ error }}</p>
    </form>
  </section>
</template>

<script setup>
import { reactive, ref } from 'vue';
import api from '../api/http';

const emit = defineEmits(['login-success']);

const form = reactive({
  email: 'admin@example.com',
  password: 'password'
});
const loading = ref(false);
const error = ref('');

async function handleSubmit() {
  loading.value = true;
  error.value = '';
  try {
    const { data } = await api.post('/login', form);
    localStorage.setItem('auth_token', data.token);
    emit('login-success');
  } catch (err) {
    error.value = err.response?.data?.message || 'Login failed';
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
.container {
  max-width: 400px;
  margin: 4rem auto;
  background: #fff;
  padding: 2rem;
  border-radius: 0.75rem;
  box-shadow: 0 20px 25px -15px rgba(15, 23, 42, 0.35);
}

h1 {
  margin-bottom: 1.5rem;
  text-align: center;
}

.card {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #d1d5db;
  border-radius: 0.5rem;
}

button {
  padding: 0.75rem;
  border: none;
  border-radius: 0.5rem;
  background: #2563eb;
  color: #fff;
  font-size: 1rem;
}

.error {
  color: #dc2626;
  text-align: center;
}
</style>
