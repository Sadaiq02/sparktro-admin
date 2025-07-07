<script setup>
import { Line } from 'vue-chartjs';
import { Chart, registerables } from 'chart.js';
import { ref, watch, onMounted } from 'vue';

Chart.register(...registerables);

const props = defineProps({
  chartData: { type: Object, required: true },
  chartOptions: { type: Object, default: () => ({ responsive: true, maintainAspectRatio: false }) },
  loading: { type: Boolean, default: false },
});

const error = ref(null);

watch(() => props.chartData, () => { error.value = null; });

onMounted(() => { error.value = null; });
</script>

<template>
  <div class="w-full h-full min-h-[220px] relative">
    <div v-if="loading" class="flex items-center justify-center h-full text-gray-400">Loading chart...</div>
    <div v-else-if="error" class="flex items-center justify-center h-full text-red-500">{{ error }}</div>
    <Line v-else
      :data="chartData"
      :options="chartOptions"
      @error="err => error = err.message || 'Chart error'"
      class="w-full h-full"
    />
  </div>
</template> 