<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const loading = ref(false);
const error = ref(null);
const search = ref('');
const perPage = ref(10);
const page = ref(1);
const selected = ref([]);

const pushNotifications = ref([
  {
    id: 1,
    image: '/assets/color.png',
    message: 'Welcome To Our Platform',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'All User Across Platforms',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Send',
  },
  // ... rest of your mock data ...
]);

const filteredPush = computed(() => {
  let filtered = pushNotifications.value;
  if (search.value) {
    filtered = filtered.filter(n =>
      n.message.toLowerCase().includes(search.value.toLowerCase()) ||
      n.details.toLowerCase().includes(search.value.toLowerCase()) ||
      n.audience.toLowerCase().includes(search.value.toLowerCase())
    );
  }
  return filtered;
});

const paginatedPush = computed(() => {
  const start = (page.value - 1) * perPage.value;
  return filteredPush.value.slice(start, start + perPage.value);
});

const totalPages = computed(() => Math.ceil(filteredPush.value.length / perPage.value));

function setPage(p) {
  if (p >= 1 && p <= totalPages.value) page.value = p;
}

function statusClass(status) {
  switch (status) {
    case 'Send': return 'bg-green-50 text-green-600 border-green-100';
    case 'Scheduled': return 'bg-blue-50 text-blue-500 border-blue-100';
    case 'Draft': return 'bg-gray-100 text-gray-500 border-gray-200';
    case 'Failed': return 'bg-red-50 text-red-500 border-red-100';
    default: return 'bg-gray-100 text-gray-500 border-gray-200';
  }
}

function toggleAll(e) {
  if (e.target.checked) {
    selected.value = paginatedPush.value.map(n => n.id);
  } else {
    selected.value = [];
  }
}

function toggleRow(id) {
  if (selected.value.includes(id)) {
    selected.value = selected.value.filter(i => i !== id);
  } else {
    selected.value.push(id);
  }
}
</script>

<template>
  <Head title="Push Notifications" />
  <AuthenticatedLayout>
    <!-- Adjusted container to work with sidebar -->
    <div class="flex-1 p-4 sm:p-6 bg-[#F8FAFC] min-h-[calc(100vh-80px)]">
      <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 sm:px-6 py-4 gap-4 border-b border-gray-200">
          <h2 class="text-xl font-bold text-gray-800">Push Notifications</h2>
          <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <div class="flex items-center gap-2">
              <label class="text-sm text-gray-500 font-medium hidden sm:block">Show</label>
              <select v-model="perPage" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 w-20">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
            </div>
            <input 
              v-model="search" 
              type="text" 
              placeholder="Search notifications..." 
              class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition w-full sm:w-64"
            >
           
          </div>
        </div>

        <!-- Mobile Card View -->
        <div class="block sm:hidden p-4">
          <div class="space-y-3">
            <div v-for="(n, idx) in paginatedPush" :key="n.id" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-sm transition-shadow">
              <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                  <input type="checkbox" :checked="selected.includes(n.id)" @change="toggleRow(n.id)" class="accent-[#0A97B0] w-4 h-4 rounded" />
                  <img :src="n.image" alt="img" class="w-10 h-10 rounded-full object-cover border border-gray-200" />
                </div>
                <button class="text-gray-400 hover:text-gray-600 p-1">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                  </svg>
                </button>
              </div>
              <div class="space-y-2">
                <div>
                  <div class="font-semibold text-gray-800">{{ n.message }}</div>
                  <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ n.details }}</div>
                </div>
                <div class="grid grid-cols-1 gap-2 text-sm">
                  <div>
                    <span class="text-gray-500">Audience:</span>
                    <span class="ml-1 text-gray-800">{{ n.audience }}</span>
                  </div>
                  <div>
                    <span class="text-gray-500">Created:</span>
                    <span class="ml-1 text-gray-800">{{ n.created }}</span>
                  </div>
                  <div v-if="n.scheduled !== '-'">
                    <span class="text-gray-500">Scheduled:</span>
                    <span class="ml-1 text-gray-800">{{ n.scheduled }}</span>
                  </div>
                </div>
                <div class="flex items-center justify-between pt-2">
                  <span class="px-2 py-1 rounded-full text-xs font-medium border"
                        :class="statusClass(n.status)">
                    {{ n.status }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden sm:block overflow-x-auto">
          <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-50 border-b border-gray-200">
              <tr>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap">
                  <input type="checkbox" :checked="selected.length === paginatedPush.length && paginatedPush.length > 0" @change="toggleAll" class="accent-[#0A97B0] w-4 h-4 rounded" />
                </th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap">IMAGE</th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap min-w-[180px]">MESSAGE</th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap hidden lg:table-cell">AUDIENCE</th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap hidden xl:table-cell">CREATED DATE</th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap hidden xl:table-cell">SCHEDULED DATE</th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap">STATUS</th>
                <th class="px-4 py-3 font-medium text-gray-500 whitespace-nowrap text-right">ACTION</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-if="loading">
                <td colspan="8" class="px-4 py-6 text-center text-gray-400">Loading...</td>
              </tr>
              <tr v-else-if="error">
                <td colspan="8" class="px-4 py-6 text-center text-red-500">{{ error }}</td>
              </tr>
              <tr v-else-if="paginatedPush.length === 0">
                <td colspan="8" class="px-4 py-6 text-center text-gray-400">No notifications found.</td>
              </tr>
              <tr v-else v-for="(n, idx) in paginatedPush" :key="n.id" class="hover:bg-gray-50">
                <td class="px-4 py-3">
                  <input type="checkbox" :checked="selected.includes(n.id)" @change="toggleRow(n.id)" class="accent-[#0A97B0] w-4 h-4 rounded" />
                </td>
                <td class="px-4 py-3">
                  <img :src="n.image" alt="img" class="w-10 h-10 rounded-full object-cover border border-gray-200" />
                </td>
                <td class="px-4 py-3">
                  <div class="font-semibold text-gray-800">{{ n.message }}</div>
                  <div class="text-xs text-gray-500 line-clamp-2">{{ n.details }}</div>
                </td>
                <td class="px-4 py-3 hidden lg:table-cell">{{ n.audience }}</td>
                <td class="px-4 py-3 hidden xl:table-cell">{{ n.created }}</td>
                <td class="px-4 py-3 hidden xl:table-cell">{{ n.scheduled }}</td>
                <td class="px-4 py-3">
                  <span class="px-2 py-1 rounded-full text-xs font-medium border"
                        :class="statusClass(n.status)">
                    {{ n.status }}
                  </span>
                </td>
                <td class="px-4 py-3 text-right">
                  <button class="text-gray-400 hover:text-gray-600 p-1 rounded hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 border-t border-gray-200 gap-4">
          <div class="text-sm text-gray-500">
            Showing <span class="font-medium">{{ (page - 1) * perPage + 1 }}</span> to <span class="font-medium">{{ Math.min(page * perPage, filteredPush.length) }}</span> of <span class="font-medium">{{ filteredPush.length }}</span> results
          </div>
          <div class="flex items-center gap-2">
            <button 
              @click="setPage(page - 1)" 
              :disabled="page === 1"
              class="px-3 py-1.5 text-sm border border-gray-200 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Previous
            </button>
            <div class="flex items-center gap-1">
              <button 
                v-for="p in totalPages" 
                :key="p" 
                @click="setPage(p)" 
                :class="[p === page ? 'bg-[#0A97B0] text-white border-[#0A97B0]' : 'bg-white text-gray-700 border-gray-200', 'px-3 py-1 text-sm border rounded-md hover:bg-gray-50']"
              >
                {{ p }}
              </button>
            </div>
            <button 
              @click="setPage(page + 1)" 
              :disabled="page === totalPages"
              class="px-3 py-1.5 text-sm border border-gray-200 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              Next
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>