<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import genre from '@/routes/genre'
import { Head, Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import { useMovie } from '@/composables/useMovie'

const props = defineProps<{
  movies: Array<{ id: number; title: string; poster_url: string; file_path: string }>
}>()

const { search, filtered } = useMovie()
const filteredMovies = computed(() => filtered(props.movies))
</script>

<template>
    <Head title="All Movies"/>

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">All Movies</h1>

        <nav class="flex items-center justify-end gap-4">
            <Link
                v-if="$page.props.auth.user"
                :href="genre.index()"
                class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
            >
                Genre
            </Link>
        </nav>

        <h2 class="text-2xl font-bold mb-4">Daftar Film</h2>
        <input
            v-model="search"
            placeholder="Cari film..."
            class="border p-2 mb-4 text-white"
        />

        <div>
            <table class="min-w-full bg-black border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-amber-900 text-left">
                        <th class="p-3 border-b">Id</th>
                        <th class="p-3 border-b">Judul Film</th>
                        <th class="p-3 border-b">Poster</th>
                        <th class="p-3 border-b">File Path</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="movie in filteredMovies" :key="movie.id" class="hover:bg-blue-950">
                        <td class="p-3 border-b">{{ movie.id }}</td>
                        <td class="p-3 border-b">{{ movie.title }}</td>
                        <td class="p-3 border-b">
                          <img v-if="movie.poster_url" :src="movie.poster_url" alt="poster" class="h-16 w-auto" />
                          <span v-else>{{ movie.poster_url }}</span>
                        </td>
                        <td class="p-3 border-b">{{ movie.file_path }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
