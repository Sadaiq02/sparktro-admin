<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  name: { type: String, required: true },
  src: { type: String, default: null },
  size: { type: Number, default: 32 },
});

const imageError = ref(false);

const initials = computed(() => {
  const parts = props.name.trim().split(/\s+/);
  return (parts[0]?.[0] || '').concat(parts[1]?.[0] || '').toUpperCase();
});

const styleSize = computed(() => {
  return { width: `${props.size}px`, height: `${props.size}px` };
});

const handleImageError = () => {
  imageError.value = true;
  console.log(`Failed to load avatar for ${props.name}: ${props.src}`);
};
</script>

<template>
  <div :style="styleSize" class="rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
    <img 
      v-if="src && !imageError" 
      :src="src" 
      :alt="name" 
      class="w-full h-full object-cover"
      @error="handleImageError"
    />
    <span v-else class="text-xs font-bold text-gray-600 uppercase">{{ initials }}</span>
  </div>
</template> 