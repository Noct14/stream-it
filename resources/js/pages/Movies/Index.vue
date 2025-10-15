<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'
import IndexTable from '@/components/tables/IndexTable.vue'
import { useMovie } from '@/composables/useMovie'

const props = defineProps<{
  movies: Array<{ id: number; title: string; poster_url: string; file_path: string }>
}>()

const { search, filtered } = useMovie()
const filteredMovies = computed(() => filtered(props.movies))
</script>

<template>
    <Head title="Movies Index"/>
    <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">All Movies</h1>

    <input
        v-model="search"
        placeholder="Cari film..."
        class="border p-2 mb-4 text-white"
    />

    <!-- <ul>
        <li v-for="s in filteredMovies" :key="s.id">
        {{ s.title }}
        </li>
    </ul> -->

    <IndexTable :movies="filteredMovies" />
    </div>
</template>
