<script setup lang="ts">
defineProps<{
    movies: {
        id: number
        title: string
        poster_url: string
        file_path: string
    }[]
}>()
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Film</h1>

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
                <tr v-for="movies in movies" :key="movies.id" class="hover:bg-blue-950">
                    <td class="p-3 border-b">{{ movies.id }}</td>
                    <td class="p-3 border-b">{{ movies.title }}</td>
                    <td class="p-3 border-b">{{ movies.poster_url }}</td>
                    <td class="p-3 border-b">{{ movies.file_path }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
