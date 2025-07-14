<script setup>
import { Doughnut } from 'vue-chartjs';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';
import { ref, computed, watch, onMounted } from 'vue';

ChartJS.register(ArcElement, Tooltip, Legend);

const props = defineProps({
  data: { type: Array, required: true }, // [{label, value}]
  chartOptions: { 
    type: Object, 
    default: () => ({
      responsive: true,
      maintainAspectRatio: false,
      cutout: '75%',
      plugins: {
        legend: {
          position: 'right',
          labels: {
            usePointStyle: true,
            pointStyle: 'circle',
            padding: 20,
            font: {
              family: 'Work Sans',
              size: 12
            },
            generateLabels: (chart) => {
              const datasets = chart.data.datasets;
              return chart.data.labels.map((label, i) => ({
                text: `${label} (${((datasets[0].data[i] / datasets[0].data.reduce((a, b) => a + b)) * 100).toFixed(1)}%)`,
                fillStyle: datasets[0].backgroundColor[i],
                hidden: false,
                index: i,
                strokeStyle: datasets[0].backgroundColor[i],
                pointStyle: 'circle'
              }));
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
              const value = context.raw;
              const total = context.dataset.data.reduce((a, b) => a + b);
              const percentage = ((value / total) * 100).toFixed(1);
              return `${context.label}: ${percentage}%`;
            }
          }
        }
      }
    })
  },
  loading: { type: Boolean, default: false }
});

const error = ref(null);

const chartData = computed(() => ({
  labels: props.data.map(d => d.label),
  datasets: [
    {
      data: props.data.map(d => d.value),
      backgroundColor: [
        '#0A97B0',
        '#4318FF',
        '#6AD2FF',
        '#FBBF24'
      ],
      borderWidth: 0,
      hoverOffset: 4
    }
  ]
}));

watch(() => props.data, () => { error.value = null; });
onMounted(() => { error.value = null; });
</script>

<template>
  <div class="w-full h-full min-h-[220px] relative">
    <div v-if="loading" class="flex items-center justify-center h-full">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
    </div>
    <div v-else-if="error" class="flex items-center justify-center h-full text-danger">{{ error }}</div>
    <Doughnut v-else
      :data="chartData"
      :options="chartOptions"
      @error="err => error = err.message || 'Chart error'"
      class="w-full h-full"
    />
  </div>
</template> 