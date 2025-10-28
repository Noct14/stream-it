<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  genre: { id: number; name: string; slug: string }
  movies: { id: number; slug: string; title: string; poster_url: string }[]
}>()
</script>

<template>
  <Head :title="`Genre: ${genre.name}`" />
  <Navbar />

  <div class="genre-page">
    <h1 class="genre-title">{{ genre.name }}</h1>

    <section class="genre-grid">
      <div
        v-for="movie in movies"
        :key="movie.id"
        class="movie-card group"
      >
        <Link :href="`/movie/${movie.slug}`" class="movie-link">
          <div class="poster-wrapper">
            <img
              :src="movie.poster_url"
              :alt="movie.title"
              class="poster-image"
              loading="lazy"
            />
            <div class="poster-overlay">
              <h3 class="poster-title">{{ movie.title }}</h3>
            </div>
          </div>
        </Link>
      </div>
    </section>

    <div v-if="!movies.length" class="empty-state">
      <p>Belum ada film di genre ini 😢</p>
    </div>
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

.genre-title {
  font-size: clamp(1.75rem, 4vw, 2.5rem);
  font-weight: 700;
  text-align: center;
  margin-bottom: 2rem;
}

.genre-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
  gap: 1.5rem;
  justify-items: center;
  max-width: 70rem;
  margin: 0 auto;
}
.movie-card {
  width: 100%;
  max-width: 180px;
  border-radius: 0.75rem;
  overflow: hidden;
  position: relative;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.movie-card:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px var(--primary);
}
.poster-wrapper {
  position: relative;
  width: 100%;
  aspect-ratio: 2 / 3;
  overflow: hidden;
  background: #1f2937;
  border-radius: inherit;
}

.poster-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}
.movie-card:hover .poster-image {
  transform: scale(1.1);
}
.poster-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.3) 60%, transparent);
  opacity: 0;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  padding: 1rem;
  transition: opacity 0.4s ease;
}

.movie-card:hover .poster-overlay {
  opacity: 1;
}

.poster-title {
  color: white;
  font-weight: 600;
  font-size: 1rem;
  text-align: center;
  text-shadow: 0 2px 6px rgba(0, 0, 0, 0.6);
}

.empty-state {
  text-align: center;
  color: #9ca3af;
  margin-top: 5rem;
}
</style>
