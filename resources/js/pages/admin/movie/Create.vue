<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  slug: '',
  poster_url: '',
  file_path: ''
});

function submit() {
  form.post('/admin/movies');
}
</script>

<template>
  <Head title="Add Movie" />
  <AppLayout>
    <form @submit.prevent="submit" class="space-y-4 max-w-md">
      <div>
        <label>Title</label>
        <input v-model="form.title" type="text" class="w-full border rounded px-3 py-2" />
      </div>
      <div>
        <label>Slug</label>
        <input v-model="form.slug" type="text" class="w-full border rounded px-3 py-2" />
      </div>
      <div>
        <label>Poster URL</label>
        <input v-model="form.poster_url" type="text" class="w-full border rounded px-3 py-2" />
      </div>
      <div>
        <label>File Path</label>
        <input v-model="form.file_path" type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
    </form>
  </AppLayout>
</template>
