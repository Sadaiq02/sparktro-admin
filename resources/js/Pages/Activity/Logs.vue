<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const loading = ref(false);
const error = ref(null);
const search = ref('');
const activityType = ref('');
const page = ref(1);
const perPage = ref(10);

const activities = ref([
  {
    id: 1,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Courtney Henry',
      email: 'jackson@hannah.com',
      avatar: '/images/avatar1.png',
    },
    details: 'Logged in',
    status: 'Login',
    statusColor: 'green',
    ip: '192.168.0.1',
  },
  {
    id: 2,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Brooklyn Simmons',
      email: 'felicia@reid.com',
      avatar: '/images/avatar2.png',
    },
    details: 'Edited user profile',
    status: 'Edit',
    statusColor: 'blue',
    ip: '192.168.0.1',
  },
  {
    id: 3,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Jerome Bell',
      email: 'georgia@young.com',
      avatar: '/images/avatar3.png',
    },
    details: 'Deleted post #35684',
    status: 'Delete',
    statusColor: 'red',
    ip: '192.168.0.1',
  },
  {
    id: 4,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Cody Fisher',
      email: 'michelle@rivera.com',
      avatar: '/images/avatar4.png',
    },
    details: 'Failed',
    status: 'Login',
    statusColor: 'green',
    ip: '192.168.0.1',
  },
  {
    id: 5,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Annette Black',
      email: 'tanya@hill.com',
      avatar: '/images/avatar5.png',
    },
    details: 'Edit about page',
    status: 'Edit',
    statusColor: 'blue',
    ip: '192.168.0.1',
  },
  {
    id: 6,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Floyd Miles',
      email: 'jessica@hanson.com',
      avatar: '/images/avatar6.png',
    },
    details: 'Deleted blog post',
    status: 'Delete',
    statusColor: 'red',
    ip: '192.168.0.1',
  },
  {
    id: 7,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Jenny Wilson',
      email: 'nathan@roberts.com',
      avatar: '/images/avatar7.png',
    },
    details: 'Edit contact information',
    status: 'Edit',
    statusColor: 'blue',
    ip: '192.168.0.1',
  },
  {
    id: 8,
    timestamp: '17 May 2025 10:36 PM',
    user: {
      name: 'Floyd Miles',
      email: 'jessica@hanson.com',
      avatar: '/images/avatar6.png',
    },
    details: 'Deleted blog post',
    status: 'Delete',
    statusColor: 'red',
    ip: '192.168.0.1',
  },
]);

const filteredActivities = computed(() => {
  let filtered = activities.value;
  if (search.value) {
    filtered = filtered.filter(a =>
      a.user.name.toLowerCase().includes(search.value.toLowerCase()) ||
      a.user.email.toLowerCase().includes(search.value.toLowerCase()) ||
      a.details.toLowerCase().includes(search.value.toLowerCase())
    );
  }
  if (activityType.value) {
    filtered = filtered.filter(a => a.status === activityType.value);
  }
  return filtered;
});

const paginatedActivities = computed(() => {
  const start = (page.value - 1) * perPage.value;
  return filteredActivities.value.slice(start, start + perPage.value);
});

const totalPages = computed(() => Math.ceil(filteredActivities.value.length / perPage.value));

function setPage(p) {
  if (p >= 1 && p <= totalPages.value) page.value = p;
}
</script>

<template>
  <Head title="Activity Logs" />
  <AuthenticatedLayout>
    <div class="flex justify-center items-start min-h-[calc(100vh-80px)] bg-[#F8FAFC] py-8 px-2">
      <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg border border-gray-100 p-0">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between px-8 pt-8 pb-4 gap-4">
          <h2 class="text-2xl font-bold text-gray-900">Activity Logs</h2>
          <div class="flex flex-row gap-3 items-center w-full md:w-auto justify-end">
            <label class="text-sm text-gray-500 font-medium mr-2 hidden md:inline-block">Show</label>
            <select v-model="perPage" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-20">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
            </select>
            <input v-model="search" type="text" placeholder="Search" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-56" />
            <select v-model="activityType" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-40">
              <option value="">Activity Type</option>
              <option value="Login">Login</option>
              <option value="Edit">Edit</option>
              <option value="Delete">Delete</option>
            </select>
          </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto px-8 pb-4">
          <table class="min-w-full text-sm text-left text-gray-900">
            <thead class="bg-[#F8FAFC] text-gray-500 font-semibold text-xs border-b border-gray-200">
              <tr>
                <th class="px-4 py-3 align-middle"><input type="checkbox" class="form-checkbox w-4 h-4 align-middle" /></th>
                <th class="px-4 py-3 align-middle font-semibold">TIMESTAMP</th>
                <th class="px-4 py-3 align-middle font-semibold">USER</th>
                <th class="px-4 py-3 align-middle font-semibold">DETAILS</th>
                <th class="px-4 py-3 align-middle font-semibold">STATUS TYPE</th>
                <th class="px-4 py-3 align-middle font-semibold">IP ADDRESS</th>
                <th class="px-4 py-3 align-middle font-semibold text-right">ACTION</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
              <tr v-if="loading">
                <td colspan="7" class="text-center py-8 text-gray-400">Loading...</td>
              </tr>
              <tr v-else-if="error">
                <td colspan="7" class="text-center py-8 text-red-500">{{ error }}</td>
              </tr>
              <tr v-else-if="paginatedActivities.length === 0">
                <td colspan="7" class="text-center py-8 text-gray-400">No activity logs found.</td>
              </tr>
              <tr v-else v-for="activity in paginatedActivities" :key="activity.id" class="hover:bg-[#F8FAFC] group">
                <td class="px-4 py-3 align-middle"><input type="checkbox" class="form-checkbox w-4 h-4 align-middle" /></td>
                <td class="px-4 py-3 align-middle whitespace-nowrap text-[15px] font-medium">{{ activity.timestamp }}</td>
                <td class="px-4 py-3 align-middle">
                  <div class="flex items-center gap-3">
                    <img :src="activity.user.avatar" alt="avatar" class="w-8 h-8 rounded-full object-cover border border-gray-200" />
                    <div>
                      <div class="font-semibold text-gray-900 text-[15px]">{{ activity.user.name }}</div>
                      <div class="text-xs text-gray-500">{{ activity.user.email }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 align-middle text-[15px]">{{ activity.details }}</td>
                <td class="px-4 py-3 align-middle">
                  <span :class="{
                    'bg-green-50 text-green-600 border border-green-200': activity.status === 'Login',
                    'bg-blue-50 text-blue-600 border border-blue-200': activity.status === 'Edit',
                    'bg-red-50 text-red-600 border border-red-200': activity.status === 'Delete',
                  }" class="px-4 py-1 rounded-full text-xs font-semibold inline-block min-w-[56px] text-center shadow-sm">
                    {{ activity.status }}
                  </span>
                </td>
                <td class="px-4 py-3 align-middle text-[15px]">{{ activity.ip }}</td>
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
            Show {{ paginatedActivities.length }} out of {{ filteredActivities.length }}
          </div>
          <div class="flex gap-1">
            <button @click="setPage(page - 1)" :disabled="page === 1" class="px-2 py-1 rounded border border-gray-200 text-xs bg-white hover:bg-gray-100 disabled:opacity-50">Prev</button>
            <button v-for="p in totalPages" :key="p" @click="setPage(p)" :class="[p === page ? 'bg-[#0A97B0] text-white' : 'bg-white text-gray-700', 'px-2 py-1 rounded border border-gray-200 text-xs hover:bg-gray-100']">{{ p }}</button>
            <button @click="setPage(page + 1)" :disabled="page === totalPages" class="px-2 py-1 rounded border border-gray-200 text-xs bg-white hover:bg-gray-100 disabled:opacity-50">Next</button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template> 