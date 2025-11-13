<template>
  <section class="panel">
    <h2>Business Settings</h2>
    <form @submit.prevent="save" class="form">
      <label>
        Yandex URL
        <input type="url" v-model="form.yandex_url" required />
      </label>
      <button type="submit" :disabled="loading">
        {{ loading ? 'Saving...' : 'Save settings' }}
      </button>
      <p v-if="message" class="message">{{ message }}</p>
      <p v-if="error" class="error">{{ error }}</p>
    </form>
  </section>
</template>

<script setup>
import { onMounted, reactive, ref } from 'vue';
import api from '../api/http';

const form = reactive({
  yandex_url: ''
});
const loading = ref(false);
const message = ref('');
const error = ref('');

onMounted(loadSettings);

async function loadSettings() {
  loading.value = true;
  message.value = '';
  error.value = '';
  try {
    const { data } = await api.get('/settings');
    form.yandex_url = data.yandex_url;
  } catch (err) {
    error.value = 'Failed to load settings.';
  } finally {
    loading.value = false;
  }
}

async function save() {
  loading.value = true;
  error.value = '';
  message.value = '';
  try {
    const { data } = await api.post('/settings', form);
    form.yandex_url = data.yandex_url;
    message.value = 'Settings saved successfully.';
  } catch (err) {
    error.value = err.response?.data?.message || 'Failed to save settings.';
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
.panel {
  max-width: 600px;
  margin: 0 auto;
  background: #fff;
  padding: 2rem;
  border-radius: 0.75rem;
  box-shadow: 0 10px 25px -15px rgba(15, 23, 42, 0.25);
}

h2 {
  margin-bottom: 1.5rem;
}

.form {
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
  align-self: flex-start;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 0.5rem;
  background: #10b981;
  color: #fff;
  font-size: 1rem;
}

.error {
  color: #dc2626;
}

.message {
  color: #047857;
}
</style>
