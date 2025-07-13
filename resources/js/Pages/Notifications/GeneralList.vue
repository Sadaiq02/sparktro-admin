<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const loading = ref(false);
const error = ref(null);
const search = ref('');
const perPage = ref(10);
const page = ref(1);

const notifications = ref([
  {
    id: 1,
    icon: 'user',
    title: 'New Signup',
    message: 'A new user has successfully signed up and joined the platform.',
    date: '17 May 2025 10:36 PM',
    color: 'teal',
  },
  // ... more mock data ...
]);

const filteredNotifications = computed(() => {
  let filtered = notifications.value;
  if (search.value) {
    filtered = filtered.filter(n =>
      n.title.toLowerCase().includes(search.value.toLowerCase()) ||
      n.message.toLowerCase().includes(search.value.toLowerCase())
    );
  }
  return filtered;
});

const paginatedNotifications = computed(() => {
  const start = (page.value - 1) * perPage.value;
  return filteredNotifications.value.slice(start, start + perPage.value);
});

const totalPages = computed(() => Math.ceil(filteredNotifications.value.length / perPage.value));

function setPage(p) {
  if (p >= 1 && p <= totalPages.value) page.value = p;
}
</script>

<template>
  <Head title="General Notifications" />
  <AuthenticatedLayout>
    <div class="w-full min-h-[calc(100vh-80px)] bg-[#F8FAFC] flex items-start">
      <main class="flex-1 flex flex-col items-center">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow border border-gray-200 mt-10 mb-8 p-0">
          <!-- Controls -->
          <div class="flex flex-col md:flex-row md:items-center md:justify-between px-8 pt-8 pb-4 gap-4">
            <h2 class="text-2xl font-bold text-gray-900">General Notifications</h2>
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full md:w-auto items-stretch sm:items-center justify-end">
              <div class="flex flex-row gap-2 items-center w-full sm:w-auto">
                <label class="text-sm text-gray-500 font-medium mr-2 hidden md:inline-block">Show</label>
                <select v-model="perPage" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-20">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
              </div>
              <input v-model="search" type="text" placeholder="Search" class="border border-blue-200 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 rounded-lg px-3 py-2 text-sm w-full sm:w-56 transition" />
            </div>
          </div>
          <!-- Table -->
          <div class="overflow-x-auto px-8 pb-4">
            <table class="min-w-[800px] w-full text-sm text-left text-gray-900 border-separate border-spacing-0">
              <thead>
                <tr class="border-b border-gray-200">
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 bg-white sticky left-0 z-10">
                    <input type="checkbox" class="form-checkbox w-4 h-4 align-middle" />
                  </th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">NOTIFICATIONS</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">DATE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 text-right">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="loading">
                  <td colspan="4" class="text-center py-8 text-gray-400">Loading...</td>
                </tr>
                <tr v-else-if="error">
                  <td colspan="4" class="text-center py-8 text-red-500">{{ error }}</td>
                </tr>
                <tr v-else-if="paginatedNotifications.length === 0">
                  <td colspan="4" class="text-center py-8 text-gray-400">No notifications found.</td>
                </tr>
                <tr v-else v-for="(n, idx) in paginatedNotifications" :key="n.id" :class="idx % 2 === 1 ? 'bg-[#F8FAFC]' : 'bg-white'">
                  <td class="px-4 py-3 align-middle">
                    <input type="checkbox" class="form-checkbox w-4 h-4 align-middle" />
                  </td>
                  <td class="px-4 py-3 align-middle">
                    <div class="flex items-center gap-3">
                      <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#E6F7FA] text-[#0A97B0]">
                        <svg v-if="n.icon === 'user'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        <!-- Add more icons as needed -->
                      </span>
                      <div>
                        <div class="font-semibold text-gray-900 text-[15px]">{{ n.title }}</div>
                        <div class="text-xs text-gray-500">{{ n.message }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 align-middle text-[15px]">{{ n.date }}</td>
                  <td class="px-4 py-3 align-middle text-right">
                    <button class="text-gray-400 hover:text-[#0A97B0] p-2 rounded-full transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/></svg>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Pagination & Footer -->
          <div class="flex flex-col md:flex-row items-center justify-between px-8 pb-8 pt-2 gap-2 md:gap-0">
            <div class="text-xs text-gray-500">
              Show {{ paginatedNotifications.length }} out of {{ filteredNotifications.length }}
            </div>
            <div class="flex gap-1">
              <button @click="setPage(page - 1)" :disabled="page === 1" class="px-2 py-1 rounded border border-gray-200 text-xs bg-white hover:bg-gray-100 disabled:opacity-50">Prev</button>
              <button v-for="p in totalPages" :key="p" @click="setPage(p)" :class="[p === page ? 'bg-[#0A97B0] text-white' : 'bg-white text-gray-700', 'px-2 py-1 rounded border border-gray-200 text-xs hover:bg-gray-100']">{{ p }}</button>
              <button @click="setPage(page + 1)" :disabled="page === totalPages" class="px-2 py-1 rounded border border-gray-200 text-xs bg-white hover:bg-gray-100 disabled:opacity-50">Next</button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </AuthenticatedLayout>
</template> 