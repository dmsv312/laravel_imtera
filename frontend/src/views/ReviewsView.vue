<template>
  <section class="reviews">
    <div class="summary" v-if="summary">
      <h2>Company Summary</h2>
      <div class="stats">
        <div>
          <span class="label">Rating</span>
          <span class="value">{{ summary.rating }}</span>
        </div>
        <div>
          <span class="label">Total reviews</span>
          <span class="value">{{ summary.reviews_total }}</span>
        </div>
      </div>
    </div>

    <div class="list">
      <h3>Latest Reviews</h3>
      <p v-if="error" class="error">{{ error }}</p>
      <article v-for="review in reviews" :key="review.id" class="review-card">
        <header>
          <h4>{{ review.author }}</h4>
          <span class="rating">{{ review.rating }}/5</span>
        </header>
        <small>{{ review.date }}</small>
        <p>{{ review.text }}</p>
      </article>
      <p v-if="!error && !reviews.length" class="empty">No reviews available yet.</p>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import api from '../api/http';

const summary = ref(null);
const reviews = ref([]);
const error = ref('');

onMounted(async () => {
  try {
    const [summaryRes, reviewsRes] = await Promise.all([
      api.get('/summary'),
      api.get('/reviews')
    ]);
    summary.value = summaryRes.data;
    reviews.value = reviewsRes.data;
    error.value = '';
  } catch (err) {
    summary.value = null;
    reviews.value = [];
    error.value = 'Failed to load reviews.';
  }
});
</script>

<style scoped>
.reviews {
  display: grid;
  gap: 1.5rem;
  max-width: 900px;
  margin: 0 auto;
}

.summary,
.list {
  background: #fff;
  padding: 1.5rem;
  border-radius: 0.75rem;
  box-shadow: 0 10px 25px -20px rgba(15, 23, 42, 0.35);
}

.stats {
  display: flex;
  gap: 2rem;
  margin-top: 1rem;
}

.label {
  display: block;
  color: #6b7280;
}

.value {
  font-size: 1.75rem;
  font-weight: 600;
}

.review-card {
  border-bottom: 1px solid #e5e7eb;
  padding: 1rem 0;
}

.review-card:last-child {
  border-bottom: none;
}

.review-card header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.rating {
  background: #f59e0b;
  color: #fff;
  padding: 0.25rem 0.5rem;
  border-radius: 0.375rem;
}

.empty {
  text-align: center;
  color: #9ca3af;
}

.error {
  color: #dc2626;
}
</style>
