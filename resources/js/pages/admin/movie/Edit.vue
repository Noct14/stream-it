<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Swal from "sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css'
import { Head, useForm, router } from '@inertiajs/vue3';
import { watch } from 'vue';

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

const props = defineProps<{
  movie: {
    id: number;
    title: string;
    slug: string;
    poster_url: string | null;
    file_path: string | null;
  };
}>();

const form = useForm({
  title: props.movie.title,
  slug: props.movie.slug,
  poster_url: props.movie.poster_url || '',
  video: null as File | null,
  _method: 'put' as string,
});

function onFileChange(e: Event) {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    form.video = target.files[0];
  }
}

// function submit() {
//   form.post(`/admin/movies/${props.movie.id}`, { forceFormData: true });
// }

function submit() {
  // Cek apakah *tidak ada satupun perubahan*
  if (!form.title && !form.slug && !form.poster_url && !form.video) {
    Toast.fire({
      icon: 'warning',
      title: 'Tidak ada perubahan yang dilakukan.'
    });
    return;
  }

  // Validasi hanya jika field tersebut diisi
  if (form.poster_url) {
    const urlPattern = /^(https?:\/\/[^\s$.?#].[^\s]*)$/i;
    if (!urlPattern.test(form.poster_url)) {
      Toast.fire({
        icon: 'error',
        title: 'Masukkan URL gambar yang valid.'
      });
      return;
    }
  }

  form.processing = true;
  // Siapkan form data (hanya field yang diisi aja)
  const data = new FormData();

  if (form.title) data.append("title", form.title);
  if (form.slug) data.append("slug", form.slug);
  if (form.poster_url) data.append("poster_url", form.poster_url);
  if (form.video) data.append("video", form.video);
  // NOTE: ini penting — backtick (`) biar bisa interpolasi ID
  router.post(`/admin/movies/${props.movie.id}?_method=PUT`, data, {
    onFinish: () => (form.processing = false),
    onSuccess: () => {
      Toast.fire({
        icon: 'success',
        title: 'Perubahan berhasil disimpan!'
      });
    },
  });
}

function slugify(text: string) {
  return text.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
}

watch(() => form.title, (newTitle) => {
  form.slug = slugify(newTitle);
});
</script>

<template>
  <Head title="Edit Movie" />
  <AppLayout>
    <div class="form-container">
      <h1>Edit Movie</h1>
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="form-group">
          <label>Title</label>
          <input v-model="form.title" type="text" />
        </div>

        <div class="form-group">
          <label>Slug</label>
          <input v-model="form.slug" type="text"/>
        </div>

        <div class="form-group">
          <label>Poster URL</label>
          <input v-model="form.poster_url" type="text" />
        </div>

        <div class="form-group">
          <label>Replace Video (optional)</label>
          <input type="file" accept="video/*" @change="onFileChange" />
          <p v-if="props.movie.file_path" class="file-path">Current file: {{ props.movie.file_path }}</p>
        </div>

        <button type="submit" :disabled="form.processing">
          {{ form.processing ? 'Updating...' : 'Update Movie' }}
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
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input[type="text"]:focus,
input[type="file"]:focus {
  outline: none;
  border-color: rgb(0, 120, 255);
  box-shadow: 0 0 0 3px rgba(0, 120, 255, 0.25);
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
