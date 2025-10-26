<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { watch } from 'vue'

// Props declaration
const props = defineProps<{
  movie: {
    id: number
    title: string
    slug: string
    poster_url: string | null
    file_path: string | null
  }
}>()

const form = useForm({
  title: props.movie.title,
  slug: props.movie.slug,
  poster_url: props.movie.poster_url || '',
  video: null as File | null,
  _method: 'put' as string,
})

function onFileChange(e: Event) {
  const target = e.target as HTMLInputElement
  if (target.files && target.files[0]) {
    form.video = target.files[0]
  }
}

function submit() {
  form.post(`/admin/movies/${props.movie.id}`, {
    forceFormData: true,
  })
}

// Auto slugify
function slugify(text: string) {
  return text
    .toString()
    .toLowerCase()
    .trim()
    .replace(/\s+/g, '-')
    .replace(/[^\w\-]+/g, '')
    .replace(/\-\-+/g, '-')
}

watch(
  () => form.title,
  (newTitle) => {
    form.slug = slugify(newTitle)
  }
)
</script>

<template>
  <Head title="Edit Movie" />
  <AppLayout>
    <form
      @submit.prevent="submit"
      class="space-y-4 max-w-md"
      enctype="multipart/form-data"
    >
      <div>
        <label>Title</label>
        <input
          v-model="form.title"
          type="text"
          class="w-full border rounded px-3 py-2"
        />
      </div>

      <div>
        <label>Slug</label>
        <input
          v-model="form.slug"
          type="text"
          class="w-full border rounded px-3 py-2"
        />
      </div>

      <div>
        <label>Poster URL</label>
        <input
          v-model="form.poster_url"
          type="text"
          class="w-full border rounded px-3 py-2"
        />
      </div>

      <div>
        <label>Replace Video (optional)</label>
        <input
          type="file"
          accept="video/*"
          class="w-full border rounded px-3 py-2"
          @change="onFileChange"
        />
        <p v-if="props.movie.file_path" class="text-sm text-gray-600 mt-1">
          Current file: {{ props.movie.file_path }}
        </p>
      </div>

      <button
        type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded-md"
        :disabled="form.processing"
      >
        {{ form.processing ? 'Updating...' : 'Update Movie' }}
      </button>
    </form>
  </AppLayout>
</template>
