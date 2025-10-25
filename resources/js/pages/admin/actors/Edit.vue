<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { watch } from 'vue'

const props = defineProps<{
  actor: {
    id: number
    name: string
    slug: string
    image_url: string
  }
}>()

const form = useForm({
  name: props.actor.name,
  slug: props.actor.slug,
  image_url: props.actor.image_url,
})

function submit() {
  form.post(`/admin/actors/${props.actor.id}`, {
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
  () => form.name,
  (newName) => {
    form.slug = slugify(newName)
  }
)
</script>

<template>
  <Head title="Edit Actor" />
  <AppLayout>
    <form
      @submit.prevent="submit"
      class="space-y-4 max-w-md"
      enctype="multipart/form-data"
    >
        <div>
            <label>Name</label>
            <input
            v-model="form.name"
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
            <label>Image URL</label>
            <input v-model="form.image_url" type="text" class="w-full border rounded px-3 py-2" />
        </div>

      <button
        type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded-md"
        :disabled="form.processing"
      >
        {{ form.processing ? 'Updating...' : 'Update Actor' }}
      </button>
    </form>
  </AppLayout>
</template>
