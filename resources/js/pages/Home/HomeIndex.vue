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

    <section
    id="movie"
    class="px-6 py-16 min-h-screen bg-gradient-to-b from-gray-900 to-black text-[var(--foreground)]"
    >
        <!-- Title -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 tracking-wide">
            🎞️ Fan-Favorite Movies
            </h2>
            <p class="text-gray-400 text-sm md:text-base">
            Temukan film pilihan terbaik dari berbagai genre
            </p>
        </div>

        <!-- Movie Grid -->
        <div
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 justify-items-center max-w-7xl mx-auto"
        >
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

                    <!-- Overlay -->
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

        <!-- Empty State -->
        <div
            v-if="!movies || movies.length === 0"
            class="text-center text-gray-400 py-20"
        >
            <p>Belum ada data film 😢</p>
        </div>
    </section>

</template>

<style scoped>
    .hero{
        background: linear-gradient(
        to bottom,
        rgba(0, 0, 0, 0.6),
        rgba(0, 0, 0, 0.9)
        ),
        url('/images/hero-bg-small.webp') center/cover no-repeat;
    }
</style>
