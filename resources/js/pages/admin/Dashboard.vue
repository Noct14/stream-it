<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes/admin';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { BarChart } from 'vue-chart-3';
import { Chart, registerables } from 'chart.js';

defineProps<{
  stats: {
    total_users: number;
    total_movies: number;
    total_actors: number;
    total_genres: number;
  };
}>();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: dashboard().url,
  },
];

Chart.register(...registerables);

const chartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr'],
  datasets: [
    {
      label: 'New Users',
      data: [12, 19, 3, 5],
      backgroundColor: '#2563eb',
    },
  ],
};
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-6 space-y-6">
      <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div
          v-for="(value, key) in stats"
          :key="key"
          class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700"
        >
          <h2 class="text-sm text-gray-500 capitalize">
            {{ key.replace('_', ' ') }}
          </h2>
          <p class="text-3xl font-semibold mt-2">{{ value }}</p>
        </div>
      </div>
      <BarChart :chartData="chartData" />
    </div>
  </AppLayout>
</template>
