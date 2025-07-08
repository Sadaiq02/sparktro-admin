<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const roles = ref([
  { id: 1, name: 'Admin', permissions: { full: true, view: false, edit: false, create: false, delete: false } },
  { id: 2, name: 'Super Admin', permissions: { full: true, view: false, edit: false, create: false, delete: false } },
  { id: 3, name: 'Team', permissions: { full: false, view: true, edit: true, create: false, delete: true } },
  { id: 4, name: 'Editor', permissions: { full: false, view: true, edit: true, create: false, delete: false } },
  { id: 5, name: 'Viewer', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 6, name: 'User', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 7, name: 'Manager', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 8, name: 'Author', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 9, name: 'Contributor', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 10, name: 'Subscriber', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 11, name: 'Support', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
  { id: 12, name: 'Guest', permissions: { full: false, view: true, edit: false, create: false, delete: false } },
]);
const loading = ref(false);
const error = ref(null);

function togglePermission(role, perm) {
  if (perm === 'full') {
    role.permissions.full = !role.permissions.full;
    if (role.permissions.full) {
      role.permissions.view = role.permissions.edit = role.permissions.create = role.permissions.delete = true;
    }
  } else {
    role.permissions[perm] = !role.permissions[perm];
    if (!role.permissions[perm]) role.permissions.full = false;
  }
}
</script>
<template>
  <Head title="Assign Role & Permissions" />
  <AuthenticatedLayout>
    <div class="p-2 sm:p-4 md:p-8">
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-center justify-between px-4 sm:px-6 py-4 border-b border-gray-200 bg-gray-50 gap-2 md:gap-0">
          <h2 class="text-lg font-semibold text-gray-800">Assign Role & Permission</h2>
          <div class="flex items-center gap-2">
            <input type="text" placeholder="User" class="border border-gray-300 rounded px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500" />
            <select class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
              <option>Status</option>
              <option>Active</option>
              <option>Inactive</option>
            </select>
            <button class="px-4 py-2 bg-[#0A97B0] text-sm rounded text-white font-semibold shadow hover:bg-[#09879b] transition">Assign</button>
          </div>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3">Full Access</th>
                <th class="px-4 py-3">View</th>
                <th class="px-4 py-3">Edit</th>
                <th class="px-4 py-3">Create</th>
                <th class="px-4 py-3">Delete</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-if="loading">
                <td colspan="6" class="text-center py-6 text-gray-400">Loading...</td>
              </tr>
              <tr v-else-if="error">
                <td colspan="6" class="text-center py-6 text-red-500">{{ error }}</td>
              </tr>
              <tr v-else v-for="role in roles" :key="role.id" class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ role.name }}</td>
                <td class="px-4 py-3 text-center">
                  <input type="checkbox" v-model="role.permissions.full" @change="togglePermission(role, 'full')" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" />
                </td>
                <td class="px-4 py-3 text-center">
                  <input type="checkbox" v-model="role.permissions.view" @change="togglePermission(role, 'view')" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" />
                </td>
                <td class="px-4 py-3 text-center">
                  <input type="checkbox" v-model="role.permissions.edit" @change="togglePermission(role, 'edit')" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" />
                </td>
                <td class="px-4 py-3 text-center">
                  <input type="checkbox" v-model="role.permissions.create" @change="togglePermission(role, 'create')" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" />
                </td>
                <td class="px-4 py-3 text-center">
                  <input type="checkbox" v-model="role.permissions.delete" @change="togglePermission(role, 'delete')" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template> 