<script setup lang="ts">
defineProps<{
    genre: {
        id: number
        name: string
    }[]
}>()
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">List Genre</h1>

        <table class="min-w-full bg-black border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-amber-500 text-left">
                    <th class="p-3 border-b">name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="genre in genre" :key="genre.id" class=   "hover:bg-blue-500">
                    <td class="p-3 border-b">{{ genre.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
