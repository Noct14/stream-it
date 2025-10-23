<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  query: string
  movies: Array<{ id: number; slug: string; title: string; poster_url: string }>
  actors: Array<{ id: number; slug: string; name: string; image_url: string }>
}>()
</script>

<template>
  <Head :title="`Search results for '${query}'`" />
  <Navbar />

  <div class="pt-[6rem] px-6 bg-gradient-to-b from-gray-900 to-black min-h-screen text-[var(--foreground)]">
    <!-- Header -->
    <div class="text-center mb-10">
      <h1 class="text-3xl md:text-4xl font-bold mb-2 tracking-wide">🔍 Hasil Pencarian</h1>
      <p class="text-gray-400 text-sm md:text-base">
        Menampilkan hasil untuk: <span class="text-[var(--primary)]">{{ query }}</span>
      </p>
    </div>

        <!-- ACTOR SECTION -->
    <section v-if="actors.length > 0">
      <h2 class="text-2xl font-semibold mb-6 text-center text-[var(--primary)]">🎭 Actors</h2>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 justify-items-center max-w-7xl mx-auto">
        <div
          v-for="actor in actors"
          :key="actor.id"
          class="group relative w-full max-w-[180px] overflow-hidden rounded-xl shadow-md hover:shadow-[0_0_20px_var(--primary)] transition-transform duration-300 hover:scale-105"
        >
          <Link :href="`/actor/${actor.slug}`" class="block w-full h-full">
            <div class="relative aspect-[3/4] rounded-xl overflow-hidden bg-gray-800">
              <img
                v-if="actor.image_url"
                :src="actor.image_url"
                alt="actor"
                loading="lazy"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <!-- Overlay Nama -->
              <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end justify-center"
              >
                <p
                  class="text-white text-sm font-semibold mb-3 px-2 text-center truncate opacity-0 group-hover:opacity-100 group-hover:translate-y-[-4px] transition-all duration-400"
                >
                  {{ actor.name }}
                </p>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </section>

    <!-- MOVIE SECTION -->
    <section v-if="movies.length > 0" class="mb-16">
      <h2 class="text-2xl font-semibold mb-6 text-center text-[var(--primary)]">🎞️ Movies</h2>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 justify-items-center max-w-7xl mx-auto">
        <div
          v-for="movie in movies"
          :key="movie.id"
          class="group relative w-full max-w-[200px] overflow-hidden rounded-xl shadow-md hover:shadow-[0_0_20px_var(--primary)] transition-transform duration-300 hover:scale-105"
        >
          <Link :href="`/movie/${movie.slug}`" class="block w-full h-full">
            <div class="relative aspect-[2/3] rounded-xl overflow-hidden bg-gray-800">
              <img
                v-if="movie.poster_url"
                :src="movie.poster_url"
                alt="poster"
                loading="lazy"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
              />
              <!-- Overlay Judul -->
              <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end justify-center"
              >
                <p
                  class="text-white text-sm font-semibold mb-3 px-2 text-center truncate opacity-0 group-hover:opacity-100 group-hover:translate-y-[-4px] transition-all duration-400"
                >
                  {{ movie.title }}
                </p>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </section>

    <!-- EMPTY STATE -->
    <div
      v-if="!movies.length && !actors.length"
      class="text-center text-gray-400 py-20"
    >
      <p>Tidak ditemukan hasil untuk <b>{{ query }}</b> 😢</p>
    </div>
  </div>
</template>
