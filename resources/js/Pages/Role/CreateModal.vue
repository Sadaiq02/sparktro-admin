<script setup>
import { ref, defineEmits } from 'vue';

const emit = defineEmits(['close', 'create']);

const roleName = ref('');
const department = ref('');
const status = ref('Active');
const permissions = ref({ full: false, view: false, edit: false, create: false, delete: false });

function handleCreate() {
  emit('create', { roleName: roleName.value, department: department.value, status: status.value, permissions: { ...permissions.value } });
}
</script>
<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/30">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
      <button @click="$emit('close')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Create Role</h2>
      <form @submit.prevent="handleCreate" class="space-y-4">
        <div>
          <label class="block text-xs font-semibold mb-1">Role Name</label>
          <input v-model="roleName" type="text" placeholder="Manager" class="w-full border rounded px-2 py-2 text-sm text-gray-700 focus:outline-none" />
        </div>
        <div>
          <label class="block text-xs font-semibold mb-1">Department</label>
          <select v-model="department" class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
            <option value="">Select Department</option>
            <option>Management</option>
            <option>Account</option>
            <option>Designer</option>
            <option>Developer</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-semibold mb-1">Status</label>
          <select v-model="status" class="w-full border rounded px-2 py-2 text-sm text-gray-700 bg-white focus:outline-none">
            <option>Active</option>
            <option>Inactive</option>
          </select>
        </div>
        <div>
          <label class="block text-xs font-semibold mb-1">Permissions</label>
          <div class="grid grid-cols-2 gap-2 mt-1">
            <label class="flex items-center gap-2 text-sm">
              <input type="checkbox" v-model="permissions.full" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" /> Full Access
            </label>
            <label class="flex items-center gap-2 text-sm">
              <input type="checkbox" v-model="permissions.view" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" /> View
            </label>
            <label class="flex items-center gap-2 text-sm">
              <input type="checkbox" v-model="permissions.edit" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" /> Edit
            </label>
            <label class="flex items-center gap-2 text-sm">
              <input type="checkbox" v-model="permissions.create" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" /> Create
            </label>
            <label class="flex items-center gap-2 text-sm">
              <input type="checkbox" v-model="permissions.delete" class="form-checkbox h-4 w-4 text-[#0A97B0] rounded" /> Delete
            </label>
          </div>
        </div>
        <div class="flex justify-end gap-2 mt-6">
          <button type="button" @click="$emit('close')" class="px-4 py-2 bg-white border border-gray-200 text-sm rounded text-gray-800 hover:bg-gray-100 transition">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-[#0A97B0] text-sm rounded text-white font-semibold shadow hover:bg-[#09879b] transition">Create</button>
        </div>
      </form>
    </div>
  </div>
</template> 