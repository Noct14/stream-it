<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const form = useForm({
  name: '',
  slug: '',
});

function submit() {
  form.post('/admin/genres', {
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

watch(() => form.name, (newName) => {
  form.slug = slugify(newName);
});
</script>

<template>
  <Head title="Add Genre" />
  <AppLayout>
    <form @submit.prevent="submit" class="space-y-4 max-w-md">
      <div>
        <label>Title</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
      </div>
      <div>
        <label>Slug</label>
        <input v-model="form.slug" type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <button
        type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded-md"
        :disabled="form.processing"
      >
        {{ form.processing ? 'Saving...' : 'Save' }}
      </button>
    </form>
  </AppLayout>
</template>
