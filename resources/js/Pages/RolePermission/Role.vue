<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import StatusToggle from '@/Components/RolePermission/StatusToggle.vue';
import KebabMenu from '@/Components/RolePermission/KebabMenu.vue';
import UserAvatar from '@/Components/UserAvatar.vue';

const props = defineProps({
  roles: { type: Array, default: () => [] },
  perPageOptions: { type: Array, default: () => [10, 25, 50, 100] },
  initialPerPage: { type: Number, default: 10 },
  initialSearch: { type: String, default: '' },
});

/* Demo fallback (used only when no props.roles) */
const demoRows = [
  { id: 1, user: { name: 'Courtney Henry', email: 'jackson@graham.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Courtney' }, department: 'Manager',     permissionSummary: 'Full System Access',     role: 'Admin',       active: true },
  { id: 2, user: { name: 'Brooklyn Simmons', email: 'felicia@reid.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Brooklyn' }, department: 'Management', permissionSummary: 'All access',             role: 'Super Admin', active: true },
  { id: 3, user: { name: 'Jerome Bell', email: 'georgia@youngc.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Jerome' },    department: 'Account',    permissionSummary: 'Read, Write, Delete',    role: 'Team',        active: true },
  { id: 4, user: { name: 'Cody Fisher', email: 'michelle@rivera.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Cody' },   department: 'Developer',  permissionSummary: 'View, Create, Delete',    role: 'Editor',      active: true },
  { id: 5, user: { name: 'Annette Black', email: 'tanya@hill.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Annette' },      department: 'Designer',   permissionSummary: 'View, Create, Delete',    role: 'Viewer',      active: true },
  { id: 6, user: { name: 'Floyd Miles', email: 'jessica@hanson.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Floyd' },    department: 'Management', permissionSummary: 'View, Create, Delete',    role: 'User',        active: false },
  { id: 7, user: { name: 'Jenny Wilson', email: 'nathan@roberts.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Jenny' },   department: 'Designer',   permissionSummary: 'View, Create, Delete',    role: 'Manager',     active: true },
  { id: 8, user: { name: 'Floyd Miles', email: 'jessica@hanson.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Floyd2' },    department: 'Account',    permissionSummary: 'View, Create, Delete',    role: 'Author',      active: true },
  { id: 9, user: { name: 'Annette Black', email: 'tanya@hill.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Annette2' },      department: 'Designer',   permissionSummary: 'View, Create, Delete',    role: 'Contributor', active: true },
  { id:10, user: { name: 'Brooklyn Simmons', email: 'felicia@reid.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Brooklyn2' }, department: 'Account',    permissionSummary: 'View, Create, Delete',    role: 'Subscriber',  active: true },
  { id:11, user: { name: 'Floyd Miles', email: 'jessica@hanson.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Floyd3' },    department: 'Staff',      permissionSummary: 'View, Create, Delete',    role: 'Support',     active: false },
  { id:12, user: { name: 'Floyd Miles', email: 'jessica@hanson.com', avatarUrl: 'https://api.dicebear.com/7.x/avataaars/svg?seed=Floyd4' },    department: 'Designer',   permissionSummary: 'View, Create, Delete',    role: 'Guest',       active: true },
];

const rows = ref(props.roles.length ? props.roles : demoRows);

/* Controls */
const perPage = ref(props.initialPerPage);
const search = ref(props.initialSearch);

/* Filtering + paging */
const filteredRows = computed(() => {
  const q = search.value.trim().toLowerCase();
  if (!q) return rows.value;
  return rows.value.filter(r =>
    r.user.name.toLowerCase().includes(q) ||
    r.user.email.toLowerCase().includes(q) ||
    r.department.toLowerCase().includes(q) ||
    r.role.toLowerCase().includes(q)
  );
});
const pagedRows = computed(() => filteredRows.value.slice(0, perPage.value)); // simple clip; add real pagination later

/* Bulk select */
const allSelected = ref(false);
function toggleAll() {
  allSelected.value = !allSelected.value;
  pagedRows.value.forEach(r => (r._selected = allSelected.value));
}
function toggleRow(row) {
  row._selected = !row._selected;
  if (!row._selected) allSelected.value = false;
  else if (pagedRows.value.every(r => r._selected)) allSelected.value = true;
}

/* Create Role action (replace with Inertia route) */
function createRole() {
  // router.visit(route('roles.create'))  <-- when backend ready
  // temporary demo:
  alert('Create Role clicked');
}


</script>

<template>
  <Head title="Role List" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Role List</h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <!-- Page Header -->
            <div class="mb-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
              <h1 class="text-[24px] leading-[32px] font-semibold text-black-sparktro">Role List</h1>

              <div class="flex items-center gap-3 flex-wrap">
                <!-- per-page -->
                <label class="flex items-center gap-2 text-sm text-black-sparktro/80">
                  <span>Show</span>
                  <select
                    v-model.number="perPage"
                    class="h-[40px] px-3 pr-8 rounded-[8px] border border-gray-sparktro bg-white text-sm focus:outline-none focus:ring-1 focus:ring-primary-sparktro focus:border-primary-sparktro">
                    <option v-for="opt in perPageOptions" :key="opt" :value="opt">{{ opt }}</option>
                  </select>
                </label>

                <!-- search -->
                <div class="relative">
                  <input
                    v-model="search"
                    type="text"
                    placeholder="Search"
                    class="h-[40px] w-[200px] md:w-[240px] pl-9 pr-3 rounded-[8px] border border-gray-sparktro bg-white text-sm focus:outline-none focus:ring-1 focus:ring-primary-sparktro focus:border-primary-sparktro" />
                  <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-black-sparktro/50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z"/>
                  </svg>
                </div>

                <!-- create -->
                <button
                  type="button"
                  @click="createRole"
                  class="h-[40px] px-5 rounded-[8px] bg-primary-sparktro text-white text-sm font-semibold hover:bg-primary-sparktro/90 transition-colors">
                  + Create Role
                </button>
              </div>
            </div>

            <!-- Desktop / Tablet Table -->
            <div class="hidden sm:block rounded-[12px] border border-gray-sparktro bg-white overflow-hidden shadow-sm">
              <div class="overflow-x-auto">
                <table class="min-w-full text-left border-collapse">
                  <thead class="bg-gray-sparktro/60 text-black-sparktro text-sm font-semibold">
                    <tr>
                      <th class="w-[48px] px-4 py-3 text-center">
                        <input
                          type="checkbox"
                          :checked="allSelected"
                          @change="toggleAll"
                          class="h-4 w-4 rounded border-gray-sparktro text-primary-sparktro focus:ring-primary-sparktro">
                      </th>
                      <th class="px-4 py-3 whitespace-nowrap">User</th>
                      <th class="px-4 py-3 whitespace-nowrap">Department</th>
                      <th class="px-4 py-3 whitespace-nowrap">Permission</th>
                      <th class="px-4 py-3 whitespace-nowrap">Role</th>
                      <th class="px-4 py-3 whitespace-nowrap text-center">Status</th>
                      <th class="px-4 py-3 whitespace-nowrap text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="row in pagedRows"
                      :key="row.id"
                      class="border-t border-gray-sparktro hover:bg-primary-sparktro/5 transition-colors">
                      <!-- select -->
                      <td class="px-4 py-3 text-center">
                        <input
                          type="checkbox"
                          :checked="row._selected"
                          @change="() => toggleRow(row)"
                          class="h-4 w-4 rounded border-gray-sparktro text-primary-sparktro focus:ring-primary-sparktro">
                      </td>
                      <!-- user -->
                      <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                          <UserAvatar :name="row.user.name" :src="row.user.avatarUrl" />
                          <div class="leading-tight">
                            <div class="text-sm font-semibold text-black-sparktro">{{ row.user.name }}</div>
                            <div class="text-xs text-black-sparktro/60">{{ row.user.email }}</div>
                          </div>
                        </div>
                      </td>
                      <!-- dept -->
                      <td class="px-4 py-3 text-sm text-black-sparktro/80 whitespace-nowrap">
                        {{ row.department }}
                      </td>
                      <!-- permission summary -->
                      <td class="px-4 py-3 text-sm text-black-sparktro/80 whitespace-nowrap">
                        {{ row.permissionSummary }}
                      </td>
                      <!-- role -->
                      <td class="px-4 py-3 text-sm text-black-sparktro whitespace-nowrap">
                        {{ row.role }}
                      </td>
                      <!-- status -->
                      <td class="px-4 py-3 text-center">
                        <StatusToggle v-model="row.active" />
                      </td>
                      <!-- action -->
                      <td class="px-4 py-3 text-center">
                        <KebabMenu>
                          <button class="block w-full text-left px-3 py-1.5 text-sm hover:bg-gray-sparktro/60">Edit Role</button>
                          <button class="block w-full text-left px-3 py-1.5 text-sm hover:bg-gray-sparktro/60">Disable</button>
                          <button class="block w-full text-left px-3 py-1.5 text-sm hover:bg-gray-sparktro/60 text-red-sparktro">Delete</button>
                        </KebabMenu>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Mobile Cards -->
            <div class="sm:hidden space-y-3">
              <div
                v-for="row in pagedRows"
                :key="'m-'+row.id"
                class="bg-white border border-gray-sparktro rounded-[12px] p-4 shadow-sm">
                <div class="flex items-start gap-3">
                  <input
                    type="checkbox"
                    :checked="row._selected"
                    @change="() => toggleRow(row)"
                    class="mt-1 h-4 w-4 rounded border-gray-sparktro text-primary-sparktro focus:ring-primary-sparktro" />
                  <UserAvatar :name="row.user.name" :src="row.user.avatarUrl" />
                  <div class="flex-1">
                    <div class="text-sm font-semibold text-black-sparktro">{{ row.user.name }}</div>
                    <div class="text-xs text-black-sparktro/60">{{ row.user.email }}</div>
                    <div class="mt-2 text-xs text-black-sparktro/70"><strong>Dept:</strong> {{ row.department }}</div>
                    <div class="mt-1 text-xs text-black-sparktro/70"><strong>Perm:</strong> {{ row.permissionSummary }}</div>
                    <div class="mt-1 text-xs text-black-sparktro/70"><strong>Role:</strong> {{ row.role }}</div>
                  </div>
                  <div class="flex flex-col items-end gap-2">
                    <StatusToggle v-model="row.active" />
                    <KebabMenu />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
table {
  font-size: 14px;
  line-height: 20px;
}

/* Pixel-perfect spacing and dimensions */
.text-\[24px\] {
  font-size: 24px;
}

.leading-\[32px\] {
  line-height: 32px;
}

.h-\[40px\] {
  height: 40px;
}

.w-\[200px\] {
  width: 200px;
}

.w-\[240px\] {
  width: 240px;
}

.w-\[48px\] {
  width: 48px;
}

.rounded-\[8px\] {
  border-radius: 8px;
}

.rounded-\[12px\] {
  border-radius: 12px;
}

/* Ensure proper color values */
.text-black-sparktro {
  color: #1E2533;
}

.text-black-sparktro\/80 {
  color: rgba(30, 37, 51, 0.8);
}

.text-black-sparktro\/60 {
  color: rgba(30, 37, 51, 0.6);
}

.text-black-sparktro\/70 {
  color: rgba(30, 37, 51, 0.7);
}

.text-black-sparktro\/50 {
  color: rgba(30, 37, 51, 0.5);
}

.bg-primary-sparktro {
  background-color: #0A97B0;
}

.bg-primary-sparktro\/90 {
  background-color: rgba(10, 151, 176, 0.9);
}

.bg-primary-sparktro\/5 {
  background-color: rgba(10, 151, 176, 0.05);
}

.bg-gray-sparktro\/60 {
  background-color: rgba(243, 244, 246, 0.6);
}

.border-gray-sparktro {
  border-color: #F3F4F6;
}

.text-primary-sparktro {
  color: #0A97B0;
}

.text-red-sparktro {
  color: #EF4444;
}

/* Responsive improvements */
@media (max-width: 640px) {
  .overflow-x-auto {
    -webkit-overflow-scrolling: touch;
  }
  
  /* Ensure table doesn't break on very small screens */
  table {
    min-width: 600px;
  }
}

@media (max-width: 480px) {
  /* Stack controls vertically on very small screens */
  .flex-col {
    gap: 0.75rem;
  }
  
  /* Make checkboxes slightly larger for touch */
  .form-checkbox {
    min-width: 1rem;
    min-height: 1rem;
  }
}

/* Hover effects for better UX */
.hover\:bg-primary-sparktro\/5:hover {
  background-color: rgba(10, 151, 176, 0.05);
}

/* Focus states for accessibility */
.focus\:ring-1:focus {
  box-shadow: 0 0 0 1px rgba(10, 151, 176, 0.5);
}

.focus\:ring-primary-sparktro:focus {
  box-shadow: 0 0 0 1px rgba(10, 151, 176, 0.5);
}

/* Smooth transitions */
.transition-colors {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}
</style>
