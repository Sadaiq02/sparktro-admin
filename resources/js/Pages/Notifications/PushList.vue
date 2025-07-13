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
  {
    id: 2,
    image: '/assets/color.png',
    message: 'New Feature Announcement',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Customer Selection',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Send',
  },
  {
    id: 3,
    image: '/assets/color.png',
    message: 'Holiday Notice',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Subscribers Only',
    created: '17 May 2025 10:36 PM',
    scheduled: '23 May 2025 12:00 PM',
    status: 'Scheduled',
  },
  {
    id: 4,
    image: '/assets/color.png',
    message: 'System Update',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Customer Selection',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Draft',
  },
  {
    id: 5,
    image: '/assets/color.png',
    message: 'Security Alert',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Subscribers Only',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Draft',
  },
  {
    id: 6,
    image: '/assets/color.png',
    message: 'Feedback Request',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Customer Selection',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Failed',
  },
  {
    id: 7,
    image: '/assets/color.png',
    message: 'Update Requirement',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Subscribers Only',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Send',
  },
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
    <div class="w-full min-h-[calc(100vh-80px)] bg-[#F8FAFC] flex items-start">
      <main class="flex-1 flex flex-col items-center">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow border border-gray-200 mt-6 sm:mt-10 mb-8 p-0">
          <!-- Header Section -->
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 sm:px-8 pt-6 sm:pt-8 pb-4 gap-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Push Notifications</h2>
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto items-stretch sm:items-center justify-end">
              <div class="flex flex-row gap-2 items-center w-full sm:w-auto">
                <label class="text-sm text-gray-500 font-medium mr-2 hidden sm:inline-block">Show</label>
                <select v-model="perPage" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-20">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                </select>
              </div>
              <input v-model="search" type="text" placeholder="Search notifications..." class="border border-blue-200 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 rounded-lg px-3 py-2 text-sm w-full sm:w-56 transition" />
              <button class="bg-[#0A97B0] hover:bg-[#087c8d] text-white font-semibold rounded-lg px-4 sm:px-5 py-2 text-sm flex items-center justify-center gap-2 transition shadow-sm">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span class="hidden sm:inline">Create Notification</span>
                <span class="sm:hidden">Create</span>
              </button>
            </div>
          </div>

          <!-- Mobile Card View -->
          <div class="block sm:hidden px-4 pb-4">
            <div class="space-y-4">
              <div v-for="(n, idx) in paginatedPush" :key="n.id" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
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
                    <div class="font-semibold text-gray-900 text-base">{{ n.message }}</div>
                    <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ n.details }}</div>
                  </div>
                  <div class="grid grid-cols-1 gap-2 text-sm">
                    <div>
                      <span class="text-gray-500">Audience:</span>
                      <span class="ml-1 text-gray-900">{{ n.audience }}</span>
                    </div>
                    <div>
                      <span class="text-gray-500">Created:</span>
                      <span class="ml-1 text-gray-900">{{ n.created }}</span>
                    </div>
                    <div v-if="n.scheduled !== '-'">
                      <span class="text-gray-500">Scheduled:</span>
                      <span class="ml-1 text-gray-900">{{ n.scheduled }}</span>
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
          <div class="hidden sm:block overflow-x-auto px-4 sm:px-8 pb-4">
            <table class="min-w-[1100px] w-full text-sm text-left text-gray-900 border-separate border-spacing-0">
              <thead>
                <tr class="border-b border-gray-200">
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 bg-white sticky left-0 z-10">
                    <input type="checkbox" :checked="selected.length === paginatedPush.length && paginatedPush.length > 0" @change="toggleAll" class="accent-[#0A97B0] w-4 h-4 rounded" aria-label="Select all" />
                  </th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">IMAGE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">MESSAGE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 hidden lg:table-cell">AUDIENCE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 hidden xl:table-cell">CREATED DATE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 hidden xl:table-cell">SCHEDULED DATE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">STATUS</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 text-right">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="loading">
                  <td colspan="8" class="text-center py-8 text-gray-400">Loading...</td>
                </tr>
                <tr v-else-if="error">
                  <td colspan="8" class="text-center py-8 text-red-500">{{ error }}</td>
                </tr>
                <tr v-else-if="paginatedPush.length === 0">
                  <td colspan="8" class="text-center py-8 text-gray-400">No notifications found.</td>
                </tr>
                <tr v-else v-for="(n, idx) in paginatedPush" :key="n.id" :class="idx % 2 === 1 ? 'bg-[#F8FAFC]' : 'bg-white'">
                  <td class="px-4 py-3 align-middle">
                    <input type="checkbox" :checked="selected.includes(n.id)" @change="toggleRow(n.id)" class="accent-[#0A97B0] w-4 h-4 rounded" :aria-label="'Select notification ' + n.message" />
                  </td>
                  <td class="px-4 py-3 align-middle">
                    <img :src="n.image" alt="img" class="w-10 h-10 rounded-full object-cover border border-gray-200" />
                  </td>
                  <td class="px-4 py-3 align-middle min-w-[220px]">
                    <div class="font-semibold text-gray-900 text-[15px]">{{ n.message }}</div>
                    <div class="text-xs text-gray-500 line-clamp-2">{{ n.details }}</div>
                  </td>
                  <td class="px-4 py-3 align-middle text-[15px] hidden lg:table-cell">{{ n.audience }}</td>
                  <td class="px-4 py-3 align-middle text-[15px] hidden xl:table-cell">{{ n.created }}</td>
                  <td class="px-4 py-3 align-middle text-[15px] hidden xl:table-cell">{{ n.scheduled }}</td>
                  <td class="px-4 py-3 align-middle">
                    <span class="px-2 py-1 rounded-full text-xs font-medium border"
                          :class="statusClass(n.status)">
                      {{ n.status }}
                    </span>
                  </td>
                  <td class="px-4 py-3 align-middle text-right">
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
          <div v-if="totalPages > 1" class="flex items-center justify-between px-4 sm:px-8 py-4 border-t border-gray-200">
            <div class="text-sm text-gray-700">
              Showing {{ (page - 1) * perPage + 1 }} to {{ Math.min(page * perPage, filteredPush.length) }} of {{ filteredPush.length }} results
            </div>
            <div class="flex items-center gap-2">
              <button 
                @click="setPage(page - 1)" 
                :disabled="page === 1"
                class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Previous
              </button>
              <span class="text-sm text-gray-700">Page {{ page }} of {{ totalPages }}</span>
              <button 
                @click="setPage(page + 1)" 
                :disabled="page === totalPages"
                class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Next
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </AuthenticatedLayout>
</template>