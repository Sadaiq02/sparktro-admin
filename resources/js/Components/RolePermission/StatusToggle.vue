<script setup>
import { computed } from 'vue';

const props = defineProps({
  modelValue: {
    type: Boolean,
    required: true
  }
});

const emit = defineEmits(['update:modelValue']);

const toggle = () => {
  emit('update:modelValue', !props.modelValue);
};

const statusClass = computed(() => {
  return props.modelValue 
    ? 'bg-primary-sparktro' 
    : 'bg-gray-sparktro';
});

const toggleClass = computed(() => {
  return props.modelValue 
    ? 'translate-x-5' 
    : 'translate-x-0';
});
</script>

<template>
  <button
    @click="toggle"
    type="button"
    class="relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-sparktro focus:ring-offset-2"
    :class="statusClass"
  >
    <span
      aria-hidden="true"
      class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
      :class="toggleClass"
    />
  </button>
</template>
