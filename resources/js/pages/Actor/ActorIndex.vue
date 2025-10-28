<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  actors: Array<{
    id: number
    name: string
    image_url: string
    slug: string
  }>
}>()

</script>

<template>
  <Head title="All Actors" />
  <div class="min-h-screen bg-black text-white">
    <Navbar />

    <section class="pt-24 pb-10 text-center">
      <h1 class="text-4xl font-extrabold tracking-tight mb-2 bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
        Semua Aktor
      </h1>
      <p class="text-gray-400">Temukan aktor dan aktris favoritmu dari berbagai film terbaik</p>
    </section>

    <section class="max-w-7xl mx-auto px-6 pb-20">
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
        <div
          v-for="actor in actors"
          :key="actor.id"
          class="actor-card group relative bg-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300"
        >
          <Link :href="`/actor/${actor.slug}`" class="block">
            <img
              :src="actor.image_url"
              :alt="actor.name"
              class="w-full h-56 object-cover group-hover:scale-105 transition duration-500"
              loading="lazy"
            />
            <div
              class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"
            ></div>
            <div
              class="absolute bottom-0 left-0 right-0 p-3 text-center opacity-90 group-hover:opacity-100 transition duration-300"
            >
              <h3 class="text-sm font-semibold text-white truncate">{{ actor.name }}</h3>
            </div>
          </Link>
        </div>
      </div>
      <!-- Empty State -->
      <div v-if="!actors || actors.length === 0" class="text-center text-gray-400 py-20">
        <p>Belum ada data aktor 😢</p>
      </div>
    </section>
  </div>
</template>

<style scoped>
    @keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

    .actor-card {
    animation: fadeInUp 0.6s ease both;
    }
</style>
