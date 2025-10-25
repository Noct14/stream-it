<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import genre from '@/routes/admin/genres'

defineProps<{ genres: any[] }>();
</script>

<template>
  <Head title="Manage Genres" />
  <AppLayout>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Movies</h1>
      <Link :href="genre.create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Add Genre</Link>
    </div>

    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="p-3 border">ID</th>
          <th class="p-3 border">Title</th>
          <th class="p-3 border">Slug</th>
          <th class="p-3 border">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="genre in genres" :key="genre.id" class="border-t">
          <td class="p-3 border">{{ genre.id }}</td>
          <td class="p-3 border">{{ genre.name }}</td>
          <td class="p-3 border">{{ genre.slug }}</td>
          <td class="p-3 border space-x-2">
            <Link :href="`/admin/genres/${genre.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
            <form :action="`/admin/genres/${genre.id}`" method="post" @submit.prevent="$inertia.delete(`/admin/movies/${genre.id}`)">
              <button type="submit" class="text-red-600 hover:underline">Delete</button>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>
