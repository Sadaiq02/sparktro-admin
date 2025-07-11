<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const loading = ref(false);
const error = ref(null);
const search = ref('');
const perPage = ref(10);
const page = ref(1);

const pushNotifications = ref([
  {
    id: 1,
    image: '/assets/Logo.png',
    message: 'Welcome To Our Platform',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'All User Across Platforms',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Send',
  },
  {
    id: 2,
    image: '/assets/Logo.png',
    message: 'New Feature Announcement',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Customer Selection',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Send',
  },
  {
    id: 3,
    image: '/assets/Logo.png',
    message: 'Holiday Notice',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Subscribers Only',
    created: '17 May 2025 10:36 PM',
    scheduled: '23 May 2025 12:00 PM',
    status: 'Scheduled',
  },
  {
    id: 4,
    image: '/assets/Logo.png',
    message: 'System Update',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Customer Selection',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Draft',
  },
  {
    id: 5,
    image: '/assets/Logo.png',
    message: 'Security Alert',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Subscribers Only',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Draft',
  },
  {
    id: 6,
    image: '/assets/Logo.png',
    message: 'Feedback Request',
    details: 'Thank you for joining our platform. Get ready to explore tools and features built just for you.',
    audience: 'Customer Selection',
    created: '17 May 2025 10:36 PM',
    scheduled: '-',
    status: 'Failed',
  },
  {
    id: 7,
    image: '/assets/Logo.png',
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
    case 'Send': return 'bg-green-50 text-green-600 border-green-200';
    case 'Scheduled': return 'bg-blue-50 text-blue-600 border-blue-200';
    case 'Draft': return 'bg-gray-100 text-gray-500 border-gray-200';
    case 'Failed': return 'bg-red-50 text-red-500 border-red-200';
    default: return 'bg-gray-100 text-gray-500 border-gray-200';
  }
}
</script>

<template>
  <Head title="Push Notifications" />
  <AuthenticatedLayout>
    <div class="w-full min-h-[calc(100vh-80px)] bg-[#F8FAFC] flex items-start">
      <main class="flex-1 flex flex-col items-center">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow border border-gray-200 mt-10 mb-8 p-0">
          <!-- Controls -->
          <div class="flex flex-col md:flex-row md:items-center md:justify-between px-8 pt-8 pb-4 gap-4">
            <h2 class="text-2xl font-bold text-gray-900">Push Notifications</h2>
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
          <!-- Table & Mobile Card View -->
          <div class="overflow-x-auto px-8 pb-4">
            <!-- Desktop/Tablet Table View -->
            <table class="min-w-[1100px] w-full text-sm text-left text-gray-900 border-separate border-spacing-0 hidden md:table">
              <thead>
                <tr class="border-b border-gray-200">
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 bg-white sticky left-0 z-10">IMAGE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">MESSAGE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">AUDIENCE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">CREATED DATE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">SCHEDULED DATE</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500">STATUS</th>
                  <th class="px-4 py-3 align-middle font-semibold text-gray-500 text-right">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="loading">
                  <td colspan="7" class="text-center py-8 text-gray-400">Loading...</td>
                </tr>
                <tr v-else-if="error">
                  <td colspan="7" class="text-center py-8 text-red-500">{{ error }}</td>
                </tr>
                <tr v-else-if="paginatedPush.length === 0">
                  <td colspan="7" class="text-center py-8 text-gray-400">No notifications found.</td>
                </tr>
                <tr v-else v-for="(n, idx) in paginatedPush" :key="n.id" :class="idx % 2 === 1 ? 'bg-[#F8FAFC]' : 'bg-white'">
                  <td class="px-4 py-3 align-middle">
                    <img :src="n.image" alt="img" class="w-10 h-10 rounded-full object-cover border border-gray-200" />
                  </td>
                  <td class="px-4 py-3 align-middle min-w-[220px]">
                    <div class="font-semibold text-gray-900 text-[15px]">{{ n.message }}</div>
                    <div class="text-xs text-gray-500">{{ n.details }}</div>
                  </td>
                  <td class="px-4 py-3 align-middle text-[15px]">{{ n.audience }}</td>
                  <td class="px-4 py-3 align-middle text-[15px]">{{ n.created }}</td>
                  <td class="px-4 py-3 align-middle text-[15px]">{{ n.scheduled }}</td>
                  <td class="px-4 py-3 align-middle">
                    <span :class="['inline-block px-3 py-1 rounded-full border text-xs font-semibold', statusClass(n.status)]">{{ n.status }}</span>
                  </td>
                  <td class="px-4 py-3 align-middle text-right">
                    <button class="text-gray-400 hover:text-[#0A97B0] p-2 rounded-full transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/></svg>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-3">
              <div v-if="loading" class="text-center py-8 text-gray-400">Loading...</div>
              <div v-else-if="error" class="text-center py-8 text-red-500">{{ error }}</div>
              <div v-else-if="paginatedPush.length === 0" class="text-center py-8 text-gray-400">No notifications found.</div>
              <div v-else v-for="(n, idx) in paginatedPush" :key="n.id" class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <div class="flex items-start gap-3 mb-2">
                  <img :src="n.image" alt="img" class="w-12 h-12 rounded-full object-cover border border-gray-200 flex-shrink-0" />
                  <div class="flex-1 min-w-0">
                    <div class="font-semibold text-gray-900 text-base mb-1">{{ n.message }}</div>
                    <div class="text-sm text-gray-500 mb-1">{{ n.details }}</div>
                    <div class="flex flex-wrap gap-2 text-xs text-gray-500 mb-1">
                      <span><strong>Audience:</strong> {{ n.audience }}</span>
                      <span><strong>Status:</strong> <span :class="['inline-block px-2 py-0.5 rounded-full border text-xs font-semibold', statusClass(n.status)]">{{ n.status }}</span></span>
                    </div>
                    <div class="flex flex-wrap gap-2 text-xs text-gray-400">
                      <span><strong>Created:</strong> {{ n.created }}</span>
                      <span v-if="n.scheduled && n.scheduled !== '-'" class="ml-2"><strong>Scheduled:</strong> {{ n.scheduled }}</span>
                    </div>
                  </div>
                  <button class="text-gray-400 hover:text-[#0A97B0] p-2 rounded-full transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="5" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="12" cy="19" r="1.5"/></svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- Pagination & Footer -->
          <div class="flex flex-col md:flex-row items-center justify-between px-8 pb-8 pt-2 gap-2 md:gap-0">
            <div class="text-xs text-gray-500">
              Show {{ paginatedPush.length }} out of {{ filteredPush.length }}
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