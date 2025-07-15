<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: AuthenticatedLayout
});
</script>

<template>
  <Head title="Push Notifications" />

  <div class="p-4 sm:p-6">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <!-- Header -->
      <div class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 sm:py-6 border-b border-gray-200 bg-gray-50 gap-4">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Push Notifications</h2>
      </div>

      <!-- Content -->
      <div class="p-4 sm:p-6">
        <div class="text-center py-8">
          <h3 class="text-lg font-medium text-gray-900 mb-2">Push Notifications</h3>
          <p class="text-gray-600">Manage your push notification settings here.</p>
        </div>
      </div>
    </div>
  </div>
</template> 