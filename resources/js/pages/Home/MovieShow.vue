<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import Navbar from '@/components/navbar/navbar.vue'

defineProps<{
  movie: {
    id: number
    title: string
    poster_url: string
    file_path: string
  }
}>()
</script>

<template>
  <Head :title="movie.title" />

  <div class="relative min-h-screen bg-black text-white">
    <Navbar />

    <div
      class="absolute inset-0 -z-10"
      :style="{
        backgroundImage: `url(${movie.poster_url})`,
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        filter: 'blur(40px) brightness(0.4)',
      }"
    ></div>

    <main class="container mx-auto flex flex-col md:flex-row items-center justify-center px-6 py-24 gap-10">
      <img
        :src="movie.poster_url"
        :alt="movie.title"
        class="w-64 md:w-80 rounded-lg shadow-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl"
      />
      <div class="flex flex-col items-center md:items-start text-center md:text-left max-w-2xl">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">{{ movie.title }}</h1>

        <div class="relative w-full max-w-2xl rounded-lg overflow-hidden shadow-lg mb-6">
          <video
            :src="`/videos/${movie.file_path}`"
            controls
            class="w-full h-auto object-cover rounded-lg"
          ></video>
        </div>

        <p class="text-gray-300 leading-relaxed mb-6">
          Tonton film <strong>{{ movie.title }}</strong> dalam kualitas terbaik. Nikmati pengalaman menonton sinematik
          langsung dari browser kamu tanpa buffering.
        </p>
        <a
          href="#"
          class="bg-primary text-black font-semibold px-6 py-3 rounded-md shadow-lg hover:bg-yellow-400 transition transform hover:scale-105"
        >
          🎥 Tonton Sekarang
        </a>
      </div>
    </main>
  </div>
</template>
