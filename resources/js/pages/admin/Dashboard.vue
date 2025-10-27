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
      backgroundColor: 'rgba(37, 99, 235, 0.6)',
      borderRadius: 8,
      borderSkipped: false,
    },
  ],
};
</script>

<template>
  <Head title="Dashboard" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="dashboard-container">
      <h1 class="dashboard-title">Admin Dashboard</h1>

      <div class="stats-grid">
        <div v-for="(value, key) in stats" :key="key" class="stat-card">
          <div class="stat-title">{{ key.replace('_', ' ') }}</div>
          <div class="stat-value">{{ value }}</div>
        </div>
      </div>

      <div class="chart-container">
        <h2 class="chart-title">User Growth Overview</h2>
        <BarChart :chartData="chartData" />
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.dashboard-container {
  padding: 2rem;
  color: var(--foreground);
  background-color: var(--background);
  min-height: 100%;
}

.dashboard-title {
  font-size: 1.75rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  letter-spacing: -0.02em;
  color: var(--foreground);
}

/* Statistik cards */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: var(--card);
  color: var(--card-foreground);
  border: 1px solid var(--border);
  border-radius: 0.75rem;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
  padding: 1.5rem;
  transition: all 0.3s ease;
}
.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}
.stat-title {
  font-size: 0.9rem;
  text-transform: capitalize;
  color: var(--muted-foreground);
  margin-bottom: 0.5rem;
}
.stat-value {
  font-size: 2rem;
  font-weight: 600;
  color: var(--foreground);
}

/* Chart section */
.chart-container {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 0.75rem;
  padding: 1.5rem;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
  transition: background-color 0.3s ease;
}
.chart-title {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 1rem;
  color: var(--muted-foreground);
}

/* Responsiveness */
@media (max-width: 768px) {
  .dashboard-container {
    padding: 1.25rem;
  }
  .dashboard-title {
    font-size: 1.5rem;
  }
}
</style>
