<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import CreateModal from './CreateModal.vue';

const roles = ref([
  { id: 1, name: 'Courtney Henry', email: 'jackson@hannah.com', department: 'Manager', permission: 'Full System Access', role: 'Admin', status: true, image: '/images/avatar1.png' },
  { id: 2, name: 'Brooklyn Simmons', email: 'felicia@reid.com', department: 'Management', permission: 'All access', role: 'Super Admin', status: true, image: '/images/avatar2.png' },
  { id: 3, name: 'Jerome Bell', email: 'georgia@young.com', department: 'Account', permission: 'Read, Write, Delete', role: 'Team', status: true, image: '/images/avatar3.png' },
  { id: 4, name: 'Cody Fisher', email: 'michelle@rivera.com', department: 'Developer', permission: 'View, Create, Delete', role: 'Editor', status: true, image: '/images/avatar4.png' },
  { id: 5, name: 'Anette Black', email: 'tanya@hill.com', department: 'Designer', permission: 'View, Create, Delete', role: 'Viewer', status: true, image: '/images/avatar5.png' },
  { id: 6, name: 'Floyd Miles', email: 'jessica@hanson.com', department: 'Management', permission: 'View, Create, Delete', role: 'User', status: false, image: '/images/avatar6.png' },
]);
const loading = ref(false);
const error = ref(null);
const showCreateModal = ref(false);

function toggleStatus(role) {
  role.status = !role.status;
}

const handleCreateRole = (newRole) => {
  showCreateModal.value = false;
  roles.value.push({
    id: roles.value.length + 1,
    name: newRole.roleName,
    email: '',
    department: newRole.department,
    permission: Object.keys(newRole.permissions).filter(p => newRole.permissions[p]).join(', '),
    role: newRole.roleName,
    status: newRole.status === 'Active',
    image: '/images/avatar1.png',
  });
};
</script>
<template>
  <Head title="Role List" />
  <AuthenticatedLayout>
    <div class="p-2 sm:p-4 md:p-8">
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200 bg-gray-50 gap-2 md:gap-0">
          <h2 class="text-lg font-semibold text-gray-800">Role List</h2>
          <div class="flex items-center gap-2">
            <select class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
              <option value="10">Show 10</option>
              <option value="25">Show 25</option>
              <option value="50">Show 50</option>
            </select>
            <input type="text" placeholder="Search" class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500" />
            <button @click="showCreateModal = true" class="px-4 py-2 bg-[#0A97B0] text-sm rounded text-white font-semibold shadow hover:bg-[#09879b] transition">+ Create Role</button>
          </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-3"><input type="checkbox" /></th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">Department</th>
                <th class="px-4 py-3">Permission</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3">Status</th>
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
              <tr v-else v-for="role in roles" :key="role.id" class="hover:bg-gray-50">
                <td class="px-4 py-3"><input type="checkbox" /></td>
                <td class="px-4 py-3 flex items-center gap-2">
                  <img :src="role.image" alt="avatar" class="w-8 h-8 rounded-full object-cover" />
                  <div>
                    <div class="font-medium text-gray-800">{{ role.name }}</div>
                    <div class="text-xs text-gray-500">{{ role.email }}</div>
                  </div>
                </td>
                <td class="px-4 py-3">{{ role.department }}</td>
                <td class="px-4 py-3">{{ role.permission }}</td>
                <td class="px-4 py-3">{{ role.role }}</td>
                <td class="px-4 py-3">
                  <button @click="toggleStatus(role)" :class="role.status ? 'bg-teal-100' : 'bg-gray-200'" class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors focus:outline-none">
                    <span :class="role.status ? 'translate-x-6 bg-[#0A97B0]' : 'translate-x-1 bg-gray-400'" class="inline-block w-4 h-4 transform rounded-full transition-transform"></span>
                  </button>
                </td>
                <td class="px-4 py-3 text-right">
                  <button class="text-gray-500 hover:text-[#0A97B0]">
                    <i class="material-icons-outlined">more_vert</i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <CreateModal v-if="showCreateModal" @close="showCreateModal = false" @create="handleCreateRole" />
  </AuthenticatedLayout>
</template> 