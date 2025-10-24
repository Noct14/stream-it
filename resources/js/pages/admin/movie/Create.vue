<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const form = useForm({
  title: '',
  slug: '',
  poster_url: '',
  video: null as File | null,
});

function onFileChange(e: Event) {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    form.video = target.files[0];
  }
}

function submit() {
  form.post('/admin/movies', {
    forceFormData: true,
  });
}

function slugify(text: string) {
  return text
    .toString()
    .toLowerCase()
    .trim()
    .replace(/\s+/g, '-')
    .replace(/[^\w\-]+/g, '')
    .replace(/\-\-+/g, '-');
}

watch(() => form.title, (newTitle) => {
  form.slug = slugify(newTitle);
});
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
        <label>Video File</label>
        <input
        type="file"
        accept="video/*"
        class="w-full border rounded px-3 py-2"
        @change="onFileChange"
        />
      </div>

      <button
        type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded-md"
        :disabled="form.processing"
      >
        {{ form.processing ? 'Uploading...' : 'Save' }}
      </button>
    </form>
  </AppLayout>
</template>
