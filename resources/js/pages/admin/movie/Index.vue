<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router  } from '@inertiajs/vue3';
import movie from '@/routes/admin/movies';
import Swal from 'sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'
import { ref } from 'vue'

function ConfirmDialog(options: {
  title?: string
  text?: string
  icon?: 'success' | 'error' | 'warning' | 'info' | 'question'
  confirmButtonText?: string
  cancelButtonText?: string
} = {}) {
  const isDark = document.documentElement.classList.contains('dark')

  return Swal.fire({
    title: options.title || 'Apakah kamu yakin?',
    text: options.text || 'Tindakan ini tidak dapat dibatalkan.',
    icon: options.icon || 'warning',
    showCancelButton: true,
    confirmButtonText: options.confirmButtonText || 'Ya, lanjutkan',
    cancelButtonText: options.cancelButtonText || 'Batal',
    reverseButtons: true,
    background: isDark
      ? 'linear-gradient(145deg, #0f172a, #1e293b)'
      : 'linear-gradient(145deg, #ffffff, #f8fafc)',
    color: isDark ? '#f1f5f9' : '#1e293b',
    iconColor: options.icon === 'warning'
      ? '#fbbf24'
      : options.icon === 'success'
      ? '#22c55e'
      : options.icon === 'error'
      ? '#ef4444'
      : options.icon === 'info'
      ? '#3b82f6'
      : '#a855f7',
    customClass: {
      popup:
        'rounded-2xl shadow-2xl border border-gray-200 dark:border-slate-700 p-6 backdrop-blur-sm',
      title: 'text-lg font-semibold mb-1',
      htmlContainer: 'text-sm text-gray-600 dark:text-gray-400',
      confirmButton:
        'bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200',
      cancelButton: isDark
        ? 'bg-slate-700 hover:bg-slate-600 text-gray-200 font-medium px-5 py-2.5 rounded-lg transition-all duration-200'
        : 'bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-5 py-2.5 rounded-lg transition-all duration-200',
    },
    buttonsStyling: false,
    showClass: {
      popup: 'animate__animated animate__fadeInDown animate__faster',
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp animate__faster',
    },
  })
}


const isDark = document.documentElement.classList.contains('dark');

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3500,
  timerProgressBar: true,
  background: isDark
    ? 'linear-gradient(135deg, #1e293b, #0f172a)' // dark mode
    : 'linear-gradient(135deg, #ffffff, #f8fafc)', // light mode
  color: isDark ? '#f8fafc' : '#1e293b',
  customClass: {
    popup: isDark
      ? 'rounded-xl shadow-lg border border-slate-700 px-4 py-3'
      : 'rounded-xl shadow-lg border border-gray-200 px-4 py-3',
  },
});

const showPoster = ref<boolean>(false)
const selectedPoster = ref<string | null>(null)

const openPoster = (url: string) => {
  selectedPoster.value = url
  showPoster.value = true
}

const closePoster = () => {
  showPoster.value = false
  setTimeout(() => (selectedPoster.value = null), 300)
}
defineProps<{ movies: any[] }>();

function confirmDelete(movie: { id: number; title: string }) {
  ConfirmDialog({
    title: 'Delete Movie?',
    text: 'This movie will be permanently removed.',
    icon: 'warning',
    confirmButtonText: 'Yes, delete it',
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/admin/movies/${movie.id}`, {
        onSuccess: () => {
          Toast.fire({
            icon: 'success',
            title: 'Movie deleted successfully'
          })
        },
        onError: () => {
            Toast.fire({
                icon: 'error',
                title: 'Failed to delete movie'
         });
        }
      })
    }
  })
}
</script>

<template>
  <Head title="Manage Movies" />
  <AppLayout>
    <div class="page-container">
      <div class="page-header">
        <h1>Manage Movies</h1>
        <Link :href="movie.create()" class="btn-primary">+ Add Movie</Link>
      </div>

      <div class="table-wrapper">
        <table class="styled-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Poster</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="movie in movies" :key="movie.id">
              <td>{{ movie.id }}</td>
              <td>{{ movie.title }}</td>
              <td>{{ movie.slug }}</td>
              <td>
                <img :src="movie.poster_url" alt="Poster" class="poster-img" @click="openPoster(movie.poster_url)"/>
                <!-- Modal -->
                <transition name="bg-fade">
                    <div v-if="showPoster" class="poster-modal" @click="closePoster">
                        <transition name="poster-zoom">
                        <img
                            v-if="selectedPoster"
                            :src="selectedPoster"
                            alt="Full Poster"
                            class="poster-full"
                        />
                        </transition>
                    </div>
                </transition>

              </td>
              <td>
                <div class="actions">
                    <Link :href="`/admin/movies/${movie.id}/edit`" class="btn-link">Edit</Link>
                    <!-- <form :action="`/admin/movies/${movie.id}`" method="post" @submit.prevent="$inertia.delete(`/admin/movies/${movie.id}`)">
                      <button type="submit" class="btn-danger">Delete</button>
                    </form> -->
                    <button type="submit" class="btn-danger" @click="confirmDelete(movie)" >Delete</button>
                </div>
              </td>
            </tr>
            <tr v-if="!movies.length">
                <td colspan="4" class="empty-state">No Movies found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.page-container {
  padding: 2rem;
  color: var(--foreground);
}
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}
.page-header h1 {
  font-size: 1.6rem;
  font-weight: 600;
}
.table-wrapper {
  overflow-x: auto;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 0.75rem;
}
.styled-table {
  width: 100%;
  border-collapse: collapse;
}
.styled-table th,
.styled-table td {
  padding: 0.75rem 1rem;
  border-bottom: 1px solid var(--border);
  text-align: left;
}
.styled-table th {
  background: var(--muted);
  color: var(--muted-foreground);
  font-weight: 600;
}
.actions {
  align-items: center;
  display: flex;
  gap: 0.5rem;
}

.btn-link {
  position: relative;
  color: rgb(0, 4, 255);
  font-weight: 500;
  text-decoration: none;
  transition: color 0.3s ease;
}

.btn-link::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 0%;
  height: 2px;
  background: rgb(0, 4, 255);
  transition: width 0.3s ease;
}

.btn-link:hover::after {
  width: 100%;
}

.btn-danger {
  position: relative;
  background: transparent;
  border: none;
  color: rgb(255, 0, 0);
  cursor: pointer;
  font-weight: 500;
  text-decoration: none;
  transition: color 0.3s ease;
}

.btn-danger::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -2px;
  width: 0%;
  height: 2px;
  background: rgb(255, 0, 0);
  transition: width 0.3s ease;
}

.btn-danger:hover {
  color: rgb(220, 0, 0);
}

.btn-danger:hover::after {
  width: 100%;
}

.btn-primary {
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 0.5rem;
  cursor: pointer;
  background: linear-gradient(90deg, rgb(0, 4, 255), rgb(0, 120, 255));
  transition: all 0.4s ease;
}
.btn-primary:hover {
  background-position: right center;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 100, 255, 0.3);
}

.poster-img {
  width: 60px;
  height: 90px;
  object-fit: cover;
  border-radius: 6px;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  user-select: none;
}
.poster-img:hover {
  filter: brightness(0.8);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
}
.poster-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(6px);
  background: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
  cursor: zoom-out;
}
.poster-full {
  max-width: 80%;
  max-height: 90%;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease, opacity 0.3s ease;
  user-select: none;
}
.bg-fade-enter-active,
.bg-fade-leave-active {
  transition: opacity 0.3s ease;
}
.bg-fade-enter-from,
.bg-fade-leave-to {
  opacity: 0;
}
.poster-zoom-enter-active,
.poster-zoom-leave-active {
  transition: all 0.3s ease;
}
.poster-zoom-enter-from {
  transform: scale(0.9);
  opacity: 0;
}
.poster-zoom-leave-to {
  transform: scale(0.85);
  opacity: 0;
}
</style>
