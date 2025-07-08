<script setup>
import { ref, computed, watch } from 'vue';

const props = defineProps({
  selectedDate: { type: Date, default: () => new Date() },
});
const emit = defineEmits(['update:selectedDate']);

const today = new Date();
const month = ref(props.selectedDate.getMonth());
const year = ref(props.selectedDate.getFullYear());

const daysInMonth = computed(() => new Date(year.value, month.value + 1, 0).getDate());
const firstDayOfWeek = computed(() => new Date(year.value, month.value, 1).getDay());
const weeks = computed(() => {
  const days = [];
  for (let i = 0; i < firstDayOfWeek.value; i++) days.push(null);
  for (let d = 1; d <= daysInMonth.value; d++) days.push(d);
  while (days.length % 7 !== 0) days.push(null);
  return Array.from({ length: days.length / 7 }, (_, i) => days.slice(i * 7, i * 7 + 7));
});

function prevMonth() {
  if (month.value === 0) {
    month.value = 11;
    year.value--;
  } else {
    month.value--;
  }
}
function nextMonth() {
  if (month.value === 11) {
    month.value = 0;
    year.value++;
  } else {
    month.value++;
  }
}
function selectDate(day) {
  if (!day) return;
  const date = new Date(year.value, month.value, day);
  emit('update:selectedDate', date);
}

watch(() => props.selectedDate, val => {
  month.value = val.getMonth();
  year.value = val.getFullYear();
});
</script>
<template>
  <div class="w-full">
    <div class="flex items-center justify-between mb-2">
      <button @click="prevMonth" class="p-1 rounded hover:bg-gray-100">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </button>
      <span class="font-semibold text-gray-700">{{ new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' }) }}</span>
      <button @click="nextMonth" class="p-1 rounded hover:bg-gray-100">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </button>
    </div>
    <div class="grid grid-cols-7 text-xs text-center text-gray-400 mb-1">
      <span v-for="d in ['Su','Mo','Tu','We','Th','Fr','Sa']" :key="d">{{ d }}</span>
    </div>
    <div class="grid grid-cols-7 gap-1">
      <button v-for="(day, i) in weeks.flat()" :key="i"
        class="aspect-square rounded-lg flex items-center justify-center transition-colors"
        :class="{
          'bg-[#0A97B0] text-white font-bold': day && new Date(year, month, day).toDateString() === today.toDateString(),
          'bg-primary-sparktro/10 text-primary-sparktro font-semibold': day && props.selectedDate && new Date(year, month, day).toDateString() === props.selectedDate.toDateString(),
          'hover:bg-gray-100': day && new Date(year, month, day).toDateString() !== today.toDateString(),
          'text-gray-300 cursor-default': !day
        }"
        @click="selectDate(day)"
        :disabled="!day"
      >
        {{ day || '' }}
      </button>
    </div>
  </div>
</template> 