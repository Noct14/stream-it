<script setup lang="ts">
import  Navbar from '@/components/navbar/navbar.vue'
import { Head, Link } from '@inertiajs/vue3'

const { movies } = defineProps<{
  movies: Array<{ id: number; slug: string; title: string; poster_url: string; file_path: string }>
}>()

const scrollToMovies = () => {
  const target = document.querySelector('#movie')
  if (target) {
    target.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }
}
</script>

<template>
    <Head title="All Movies"/>
    <Navbar />
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome To StreamIt</h1>
            <p>Enjoy Thousands of Movies Straight from Your Device</p>
            <button @click="scrollToMovies" href="#movie" class="hero-btn">Watch Now</button>
        </div>
    </section>


    <section id="movie" class="px-6 py-10 bg-gradient-to-b from-gray-900 to-black min-h-screen">
        <h2 class="text-3xl font-bold text-white mb-8 text-center tracking-wide">
        🎞️ Fan-Favorite Movie
        </h2>

        <div
        class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 justify-items-center"
        >
            <div
                v-for="movie in movies"
                :key="movie.id"
                class="group relative overflow-hidden rounded-xl bg-gray-800 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300"
            >
                <Link :href="`/movie/${movie.slug}`" class="block">
                <img
                    v-if="movie.poster_url"
                    :src="movie.poster_url"
                    alt="poster"
                    class="rounded-xl object-contain w-auto max-h-[400px] transition-all duration-300 group-hover:brightness-110"
                />
                <div
                    class="absolute bottom-0 left-0 right-0 text-center p-3 text-white bg-black/50 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-all duration-300"
                >
                    <p class="text-sm font-semibold truncate">{{ movie.title }}</p>
                </div>
                </Link>
            </div>
        </div>

    </section>
</template>

<style>
    .hero{
        background: linear-gradient(
        to bottom,
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.9)
        ),
        url('/images/hero-bg-small.webp') center/cover no-repeat;
    }
</style>
