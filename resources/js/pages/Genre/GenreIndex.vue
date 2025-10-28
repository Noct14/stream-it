<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  genre: {
    id: number
    name: string
    slug: string
  }[]
}>()

</script>

<template>
  <Head title="All Genres" />
  <Navbar />

  <div class="genre-page">
    <div class="genre-header">
      <h1>List Genre</h1>
      <p>Pilih genre untuk menemukan film favoritmu</p>
    </div>

    <section class="genre-section">
      <div class="genre-grid">
        <div v-for="genre in genre" :key="genre.id" class="genre-card group">
          <Link :href="`/genre/${genre.slug}`" class="genre-link">
            <h3 class="genre-name">{{ genre.name }}</h3>
          </Link>
        </div>
      </div>

      <div v-if="!genre || genre.length === 0" class="genre-empty">
        <p>Belum ada genre 😢</p>
      </div>
    </section>
  </div>
</template>

<style scoped>
.genre-page {
  padding: 1.5rem;
  padding-top: 6rem;
  min-height: 100vh;
  background: var(--background);
  color: var(--foreground);
}

.genre-header {
  max-width: 64rem;
  margin: 0 auto 2.5rem;
  text-align: center;
}

.genre-header h1 {
  font-size: clamp(1.75rem, 4vw, 2.5rem);
  font-weight: 700;
  letter-spacing: -0.02em;
  margin-bottom: 0.5rem;
}

.genre-header p {
  color: #9ca3af;
  font-size: 0.95rem;
}

.genre-section {
  max-width: 64rem;
  margin: 0 auto;
  padding: 0 1rem 5rem;
}

.genre-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 1.5rem;
  justify-items: center;
}

.genre-card {
  position: relative;
  width: 100%;
  height: 7rem;
  background: linear-gradient(to bottom right, rgba(31, 41, 55, 0.8), rgba(55, 65, 81, 0.6));
  border: 1px solid rgba(107, 114, 128, 0.4);
  border-radius: 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 0.75rem;
  transition: 0.3s ease;
  overflow: hidden;
}

.genre-card:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px var(--primary);
}

.genre-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  text-decoration: none;
}

.genre-name {
  color: white;
  font-weight: 600;
  letter-spacing: 0.02em;
  font-size: 1rem;
  line-height: 1.3;
  text-align: center;
  word-break: break-word;
  white-space: normal;
  padding: 0 0.5rem;
  transition: color 0.3s ease;
}

.genre-card:hover .genre-name {
  color: var(--primary);
}

.genre-empty {
  text-align: center;
  color: #9ca3af;
  padding: 5rem 0;
}
</style>

