<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import actor from '@/routes/admin/actors';

defineProps<{ actors: any[] }>();
</script>

<template>
  <Head title="Manage Actors" />
  <AppLayout>
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Movies</h1>
      <Link :href="actor.create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Add Actor</Link>
    </div>

    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="p-3 border">ID</th>
          <th class="p-3 border">Title</th>
          <th class="p-3 border">Slug</th>
          <th class="p-3 border">Image</th>
          <th class="p-3 border">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="actor in actors" :key="actor.id" class="border-t">
            <td class="p-3 border">{{ actor.id }}</td>
            <td class="p-3 border">{{ actor.name }}</td>
            <td class="p-3 border">{{ actor.slug }}</td>
            <td class="p-3 border text-center">
            <img
                :src="actor.image_url"
                alt="Actor Image"
                class="w-16 h-16 object-cover rounded mx-auto"
            />
            </td>
            <td class="p-3 border space-x-2">
                <Link :href="`/admin/actors/${actor.id}/edit`" class="text-blue-600 hover:underline">Edit</Link>
                <form :action="`/admin/actors/${actor.id}`" method="post" @submit.prevent="$inertia.delete(`/admin/movies/${actor.id}`)">
                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>
