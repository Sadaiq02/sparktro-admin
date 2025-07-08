<script setup>
import { Pie } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import { ref, computed, watch, onMounted } from 'vue';

Chart.register(...registerables);

const props = defineProps({
  data: { type: Array, required: true }, // [{label, value}]
  chartOptions: { type: Object, default: () => ({ responsive: true, maintainAspectRatio: false }) },
  loading: { type: Boolean, default: false },
});

const error = ref(null);

const chartData = computed(() => ({
  labels: props.data.map(d => d.label),
  datasets: [
    {
      data: props.data.map(d => d.value),
      backgroundColor: [
        '#0A97B0', '#A0AEC0', '#FBBF24', '#6366F1', '#F87171', '#34D399', '#F472B6', '#F59E42'
      ],
      borderWidth: 1,
    },
  ],
}));

watch(() => props.data, () => { error.value = null; });
onMounted(() => { error.value = null; });
</script>

<template>
  <div class="w-full h-full min-h-[220px] relative">
    <div v-if="loading" class="flex items-center justify-center h-full text-gray-400">Loading chart...</div>
    <div v-else-if="error" class="flex items-center justify-center h-full text-red-500">{{ error }}</div>
    <Pie v-else
      :data="chartData"
      :options="chartOptions"
      @error="err => error = err.message || 'Chart error'"
      class="w-full h-full"
    />
  </div>
</template> 