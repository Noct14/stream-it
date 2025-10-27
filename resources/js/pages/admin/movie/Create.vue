<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css'
import { Head, useForm, router } from '@inertiajs/vue3';
import { watch  } from 'vue';

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3500,
  timerProgressBar: true,
  background: 'linear-gradient(135deg, #1e293b, #0f172a)',
  color: '#f8fafc',
  customClass: {
    popup: 'rounded-xl shadow-lg border border-slate-700 px-4 py-3',
  },
})

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
  if (!form.title || !form.slug || !form.poster_url || !form.video) {
    Toast.fire({
    icon: 'warning',
    title: 'Please fill out all required fields before saving.'
    });
    return;
  }

  const urlPattern = /^(https?:\/\/[^\s$.?#].[^\s]*)$/i;
  if (!urlPattern.test(form.poster_url)) {
    Toast.fire({
    icon: 'error',
    title: 'Please enter a valid image URL'
    });
    return;
  }
  form.processing = true;
  const data = new FormData();
  data.append("title", form.title);
  data.append("slug", form.slug);
  data.append("poster_url", form.poster_url);
  data.append("video", form.video);

  router.post("/admin/movies", data, {
    onFinish: () => (form.processing = false),
    onSuccess: () => {
        Toast.fire({
        icon: 'success',
        title: 'Movie Added!'
        });
    },
  });
}

function slugify(text: string) {
  return text
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
    <div class="form-container">
      <h1>Add New Movie</h1>
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="form-group">
          <label>Title</label>
          <input v-model="form.title" type="text" />
        </div>

        <div class="form-group">
          <label>Slug</label>
          <input v-model="form.slug" type="text" />
        </div>

        <div class="form-group">
          <label>Poster URL</label>
          <input v-model="form.poster_url" type="text" />
        </div>

        <div class="form-group">
          <label>Video File</label>
          <input type="file" accept="video/*" @change="onFileChange"/>
        </div>

        <button type="submit" :disabled="form.processing">
          {{ form.processing ? 'Uploading...' : 'Save Movie' }}
        </button>
      </form>
    </div>
  </AppLayout>
</template>

<style scoped>
.form-container {
  max-width: 500px;
  margin: 2rem auto;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 0.75rem;
  padding: 2rem;
  color: var(--foreground);
}
h1 {
  font-size: 1.4rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
}
.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 1rem;
}
label {
  font-weight: 500;
  color: var(--muted-foreground);
  margin-bottom: 0.4rem;
}
input[type="text"],
input[type="file"] {
  border: 1px solid var(--border);
  border-radius: 0.5rem;
  padding: 0.6rem;
  background: var(--input);
  color: var(--foreground);
}
button {
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 0.5rem;
  cursor: pointer;
  background: linear-gradient(90deg, rgb(0, 4, 255), rgb(0, 120, 255));
  transition: all 0.4s ease;
}
button:hover {
  background-position: right center;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 100, 255, 0.3);
}
</style>
