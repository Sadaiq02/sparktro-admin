<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
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
const search = ref('');
const selectedRoles = ref([]);

const filteredRoles = computed(() => {
  if (!search.value) return roles.value;
  
  return roles.value.filter(role => 
    role.name.toLowerCase().includes(search.value.toLowerCase()) ||
    role.email.toLowerCase().includes(search.value.toLowerCase()) ||
    role.department.toLowerCase().includes(search.value.toLowerCase()) ||
    role.role.toLowerCase().includes(search.value.toLowerCase())
  );
});

function toggleStatus(role) {
  role.status = !role.status;
}

function toggleRoleSelection(roleId) {
  const index = selectedRoles.value.indexOf(roleId);
  if (index > -1) {
    selectedRoles.value.splice(index, 1);
  } else {
    selectedRoles.value.push(roleId);
  }
}

function selectAllRoles(event) {
  if (event.target.checked) {
    selectedRoles.value = filteredRoles.value.map(role => role.id);
  } else {
    selectedRoles.value = [];
  }
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
    <div class="p-4 sm:p-6">
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-4 sm:px-6 py-4 sm:py-6 border-b border-gray-200 bg-gray-50 gap-4">
          <div class="flex items-center gap-3">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Role List</h2>
            <span v-if="selectedRoles.length > 0" class="text-sm text-gray-600 bg-gray-200 px-2 py-1 rounded">
              {{ selectedRoles.length }} selected
            </span>
          </div>
          <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
            <!-- Search Input -->
            <div class="relative flex-1 sm:flex-none">
              <input 
                v-model="search"
                type="text" 
                placeholder="Search roles..." 
                class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
              >
              <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
            <button @click="showCreateModal = true" class="px-4 py-2 bg-[#0A97B0] text-sm rounded-lg text-white font-semibold shadow hover:bg-[#09879b] transition flex items-center justify-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
              </svg>
              Create Role
            </button>
          </div>
        </div>

        <!-- Mobile Card View -->
        <div class="block sm:hidden">
          <div class="p-4 space-y-4">
            <div v-for="role in filteredRoles" :key="role.id" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
              <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                  <input 
                    type="checkbox" 
                    :checked="selectedRoles.includes(role.id)"
                    @change="toggleRoleSelection(role.id)"
                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                  >
                  <img :src="role.image" alt="avatar" class="w-12 h-12 rounded-full object-cover" />
                </div>
                <button class="text-gray-400 hover:text-gray-600 p-1">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                  </svg>
                </button>
              </div>
              <div class="space-y-2">
                <div>
                  <div class="font-medium text-gray-900 text-base">{{ role.name }}</div>
                  <div class="text-sm text-gray-500">{{ role.email }}</div>
                </div>
                <div class="grid grid-cols-1 gap-2 text-sm">
                  <div>
                    <span class="text-gray-500">Department:</span>
                    <span class="ml-1 text-gray-900">{{ role.department }}</span>
                  </div>
                  <div>
                    <span class="text-gray-500">Permission:</span>
                    <span class="ml-1 text-gray-900">{{ role.permission }}</span>
                  </div>
                  <div>
                    <span class="text-gray-500">Role:</span>
                    <span class="ml-1 text-gray-900">{{ role.role }}</span>
                  </div>
                </div>
                <div class="flex items-center justify-between pt-2">
                  <button @click="toggleStatus(role)" :class="role.status ? 'bg-teal-100' : 'bg-gray-200'" class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors focus:outline-none">
                    <span :class="role.status ? 'translate-x-6 bg-[#0A97B0]' : 'translate-x-1 bg-gray-400'" class="inline-block w-4 h-4 transform rounded-full transition-transform"></span>
                  </button>
                  <span class="text-xs text-gray-500">{{ role.status ? 'Active' : 'Inactive' }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden sm:block overflow-x-auto">
          <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-3">
                  <input 
                    type="checkbox" 
                    :checked="selectedRoles.length === filteredRoles.length && filteredRoles.length > 0"
                    @change="selectAllRoles"
                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                  />
                </th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3 hidden md:table-cell">Department</th>
                <th class="px-4 py-3 hidden lg:table-cell">Permission</th>
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
              <tr v-else-if="filteredRoles.length === 0">
                <td colspan="7" class="text-center py-8 text-gray-400">
                  <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 01 3-3.87m9-4a4 4 0 1 0-8 0 4 4 0 0 0 8 0z"></path>
                  </svg>
                  <h3 class="mt-2 text-sm font-medium text-gray-900">No roles found</h3>
                  <p class="mt-1 text-sm text-gray-500">
                    {{ search ? 'Try adjusting your search terms.' : 'Get started by creating a new role.' }}
                  </p>
                </td>
              </tr>
              <tr v-else v-for="role in filteredRoles" :key="role.id" class="hover:bg-gray-50">
                <td class="px-4 py-3">
                  <input 
                    type="checkbox" 
                    :checked="selectedRoles.includes(role.id)"
                    @change="toggleRoleSelection(role.id)"
                    class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                  />
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center gap-3">
                  <img :src="role.image" alt="avatar" class="w-8 h-8 rounded-full object-cover" />
                  <div>
                    <div class="font-medium text-gray-800">{{ role.name }}</div>
                    <div class="text-xs text-gray-500">{{ role.email }}</div>
                  </div>
                  </div>
                </td>
                <td class="px-4 py-3 hidden md:table-cell">{{ role.department }}</td>
                <td class="px-4 py-3 hidden lg:table-cell">{{ role.permission }}</td>
                <td class="px-4 py-3">
                  <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ role.role }}
                  </span>
                </td>
                <td class="px-4 py-3">
                  <button @click="toggleStatus(role)" :class="role.status ? 'bg-teal-100' : 'bg-gray-200'" class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors focus:outline-none">
                    <span :class="role.status ? 'translate-x-6 bg-[#0A97B0]' : 'translate-x-1 bg-gray-400'" class="inline-block w-4 h-4 transform rounded-full transition-transform"></span>
                  </button>
                </td>
                <td class="px-4 py-3 text-right">
                  <button class="text-gray-500 hover:text-[#0A97B0] p-1 rounded hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                    </svg>
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