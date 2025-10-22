<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import genre from '@/routes/genre'
import movie from '@/routes/movies'
import actor from '@/routes/actor'
import { Link } from '@inertiajs/vue3'

const isScrolled = ref(false)

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
}

onMounted(() => window.addEventListener('scroll', handleScroll))
onUnmounted(() => window.removeEventListener('scroll', handleScroll))

const isOpen = ref(false)

</script>

<template>
  <nav class="navbar">
    <div class="navbar-container">
        <!-- Brand -->
        <Link :href="movie.index()" class="navbar-brand">
        StreamIt
        </Link>

        <!-- Search -->
        <div class="navbar-search">
        <input
            type="text"
            placeholder="Cari film..."
            class="navbar-input"
        />
        </div>

        <!-- Hamburger -->
        <button class="navbar-toggle" @click="isOpen = !isOpen">
        <svg
            v-if="!isOpen"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="w-6 h-6"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            class="w-6 h-6"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Menu (Desktop) -->
      <div class="navbar-menu desktop">
        <Link :href="genre.index()" class="navbar-item">Genre</Link>
        <Link :href="movie.index()" class="navbar-item">Movie</Link>
        <Link :href="actor.index()" class="navbar-item">Actor</Link>
      </div>
    </div>

    <!-- Mobile Menu -->
    <transition name="fade">
        <div v-if="isOpen" class="mobile-menu">
            <Link :href="genre.index()" class="mobile-item" @click="isOpen = false">Genre</Link>
            <Link :href="movie.index()" class="mobile-item" @click="isOpen = false">Movie</Link>
            <Link :href="actor.index()" class="mobile-item" @click="isOpen = false">Actor</Link>
        </div>
    </transition>
  </nav>
</template>
