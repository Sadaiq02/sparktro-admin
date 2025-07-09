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
    <div class="p-4 sm:p-6 md:p-8">
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 gap-2 md:gap-0">
          <h2 class="text-lg font-semibold text-gray-800">Activity Logs</h2>
          <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-center">
            <div class="relative w-full sm:w-64">
              <input v-model="search" type="text" placeholder="Search" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>
            <select v-model="activityType" class="border border-gray-300 rounded px-2 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
              <option value="">Activity Type</option>
              <option value="Login">Login</option>
              <option value="Edit">Edit</option>
              <option value="Delete">Delete</option>
            </select>
            <select v-model="perPage" class="border border-gray-300 rounded px-2 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
              <option value="10">Show 10</option>
              <option value="25">Show 25</option>
              <option value="50">Show 50</option>
            </select>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-3"><input type="checkbox" /></th>
                <th class="px-4 py-3">Timestamp</th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">Details</th>
                <th class="px-4 py-3">Status Type</th>
                <th class="px-4 py-3">IP Address</th>
                <th class="px-4 py-3 text-right">Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-if="loading">
                <td colspan="7" class="text-center py-6 text-gray-400">Loading...</td>
              </tr>
              <tr v-else-if="error">
                <td colspan="7" class="text-center py-6 text-red-500">{{ error }}</td>
              </tr>
              <tr v-else-if="paginatedActivities.length === 0">
                <td colspan="7" class="text-center py-6 text-gray-400">No activity logs found.</td>
              </tr>
              <tr v-else v-for="activity in paginatedActivities" :key="activity.id" class="hover:bg-gray-50">
                <td class="px-4 py-3"><input type="checkbox" /></td>
                <td class="px-4 py-3 whitespace-nowrap">{{ activity.timestamp }}</td>
                <td class="px-4 py-3 flex items-center gap-2">
                  <img :src="activity.user.avatar" alt="avatar" class="w-8 h-8 rounded-full object-cover" />
                  <div>
                    <div class="font-medium text-gray-800">{{ activity.user.name }}</div>
                    <div class="text-xs text-gray-500">{{ activity.user.email }}</div>
                  </div>
                </td>
                <td class="px-4 py-3">{{ activity.details }}</td>
                <td class="px-4 py-3">
                  <span :class="{
                    'bg-green-100 text-green-600': activity.status === 'Login',
                    'bg-blue-100 text-blue-600': activity.status === 'Edit',
                    'bg-red-100 text-red-600': activity.status === 'Delete',
                  }" class="px-3 py-1 rounded-full text-xs font-semibold">
                    {{ activity.status }}
                  </span>
                </td>
                <td class="px-4 py-3">{{ activity.ip }}</td>
                <td class="px-4 py-3 text-right">
                  <button class="text-gray-500 hover:text-[#0A97B0]">
                    <i class="material-icons-outlined">more_vert</i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 bg-gray-50 border-t border-gray-200 gap-2 sm:gap-0">
          <div class="text-xs text-gray-500">
            Show {{ paginatedActivities.length }} out of {{ filteredActivities.length }}
          </div>
          <div class="flex gap-1">
            <button @click="setPage(page - 1)" :disabled="page === 1" class="px-2 py-1 rounded border border-gray-300 text-xs bg-white hover:bg-gray-100 disabled:opacity-50">Prev</button>
            <button v-for="p in totalPages" :key="p" @click="setPage(p)" :class="[p === page ? 'bg-[#0A97B0] text-white' : 'bg-white text-gray-700', 'px-2 py-1 rounded border border-gray-300 text-xs hover:bg-gray-100']">{{ p }}</button>
            <button @click="setPage(page + 1)" :disabled="page === totalPages" class="px-2 py-1 rounded border border-gray-300 text-xs bg-white hover:bg-gray-100 disabled:opacity-50">Next</button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template> 