<script setup>
import { Line } from 'vue-chartjs';
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend, Filler } from 'chart.js';
import { ref, watch, onMounted } from 'vue';

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend, Filler);

const props = defineProps({
  chartData: { type: Object, required: true },
  chartOptions: { 
    type: Object, 
    default: () => ({
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'top',
          align: 'end',
          labels: {
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 20,
            font: {
              family: 'Work Sans',
              size: 12
            }
          }
        },
        tooltip: {
          backgroundColor: 'white',
          titleColor: '#1E2533',
          bodyColor: '#5A556E',
          titleFont: {
            family: 'Work Sans',
            size: 14,
            weight: '600'
          },
          bodyFont: {
            family: 'Work Sans',
            size: 12
          },
          padding: 12,
          borderColor: '#D6E2EF',
          borderWidth: 1,
          displayColors: false,
          callbacks: {
            label: function(context) {
              return `${context.dataset.label}: $${context.parsed.y}k`;
            }
          }
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            font: {
              family: 'Work Sans',
              size: 12
            },
            color: '#8D97A3'
          }
        },
        y: {
          beginAtZero: true,
          grid: {
            color: '#F1F5F9'
          },
          ticks: {
            font: {
              family: 'Work Sans',
              size: 12
            },
            color: '#8D97A3',
            callback: function(value) {
              return `$${value}k`;
            }
          }
        }
      }
    })
  },
  loading: { type: Boolean, default: false }
});

const error = ref(null);

watch(() => props.chartData, () => { error.value = null; });
onMounted(() => { error.value = null; });
</script>

<template>
  <div class="w-full h-full min-h-[220px] relative">
    <div v-if="loading" class="flex items-center justify-center h-full">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
    </div>
    <div v-else-if="error" class="flex items-center justify-center h-full text-danger">{{ error }}</div>
    <Line v-else
      :data="chartData"
      :options="chartOptions"
      @error="err => error = err.message || 'Chart error'"
      class="w-full h-full"
    />
  </div>
</template> 