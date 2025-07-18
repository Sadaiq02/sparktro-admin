<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  // Optional: you can pass menu items as props
  items: {
    type: Array,
    default: () => []
  }
});

const emit = defineEmits(['select']);

const isOpen = ref(false);

const toggleMenu = () => {
  isOpen.value = !isOpen.value;
};

const closeMenu = () => {
  isOpen.value = false;
};

const handleItemClick = (item) => {
  emit('select', item);
  closeMenu();
};

// Close menu when clicking outside
const handleClickOutside = (event) => {
  if (!event.target.closest('.kebab-menu')) {
    closeMenu();
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
  <div class="relative kebab-menu">
    <button
      @click="toggleMenu"
      type="button"
      class="p-1 rounded-md text-black-sparktro/60 hover:text-black-sparktro hover:bg-gray-sparktro/60 transition-colors duration-200"
    >
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
      </svg>
    </button>

    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-show="isOpen"
        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
      >
        <div class="py-1">
          <slot>
            <!-- Default menu items if no slot content -->
            <button
              @click="handleItemClick('edit')"
              class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
              Edit
            </button>
            <button
              @click="handleItemClick('delete')"
              class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
            >
              Delete
            </button>
          </slot>
        </div>
      </div>
    </transition>
  </div>
</template>
