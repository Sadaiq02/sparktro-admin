<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const roles = ref([
  { name: 'Admin', checked: false, permissions: ['Full Access', 'View', 'Edit', 'Create', 'Delete'] },
  { name: 'Super Admin', checked: false, permissions: ['Full Access', 'View', 'Edit', 'Create', 'Delete'] },
  { name: 'Team', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Editor', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Viewer', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'User', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Manager', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Author', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Contributor', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Subscriber', checked: false, permissions: ['Read', 'Write', 'Edit', 'Delete'] },
  { name: 'Support', checked: false, permissions: ['View', 'Create', 'Edit', 'Delete'] },
  { name: 'Guest', checked: false, permissions: ['View', 'Create', 'Edit', 'Delete'] },
]);
</script>

<template>
    <Head title="Assign Role & Permissions" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Assign Role & Permissions</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-6 bg-white rounded-lg shadow-sm">
                    <!-- Header Section -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Assign Role & Permission</h2>
                        
                        <!-- Search and Filter Controls -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4 w-full sm:w-auto">
                            <!-- User Search -->
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <label for="user" class="text-sm font-medium text-gray-600 whitespace-nowrap">User</label>
                                <div class="relative flex-1 sm:flex-none sm:w-48">
                                    <input
                                        id="user"
                                        type="text"
                                        placeholder="Enter Name"
                                        class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0A97B0] text-sm"
                                    />
                                    <svg
                                        class="w-4 h-4 text-gray-400 absolute left-2.5 top-1/2 transform -translate-y-1/2"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Status Dropdown -->
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <label for="status" class="text-sm font-medium text-gray-600 whitespace-nowrap">Status</label>
                                <select
                                    id="status"
                                    class="w-full sm:w-auto pr-8 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0A97B0] text-sm appearance-none bg-white bg-no-repeat bg-right-center"
                                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 20 20\' fill=\'currentColor\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\' clip-rule=\'evenodd\'/%3E%3C/svg%3E'); background-position: right 0.5rem center; background-size: 1.5em; padding-right: 2.5rem;"
                                >
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                            </div>
                            
                            <!-- Assign Button -->
                            <button class="w-full sm:w-auto px-5 py-2 bg-[#0A97B0] text-white rounded-md hover:bg-[#0A97B0]/80 focus:outline-none focus:ring-2 focus:ring-[#0A97B0] focus:ring-opacity-50 text-sm font-medium transition-colors duration-200">
                                Assign
                            </button>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4"
                                    >
                                        ROLE
                                    </th>
                                    <th
                                        class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        colspan="4"
                                    >
                                        PERMISSIONS
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(role, index) in roles" :key="index" class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <input
                                                type="checkbox"
                                                class="form-checkbox h-4 w-4 text-[#0A97B0] border-gray-300 rounded mr-3"
                                                :checked="role.checked"
                                            />
                                            <span class="text-sm font-medium text-gray-900">{{ role.name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <div class="flex flex-wrap gap-2 sm:gap-4">
                                            <label v-for="permission in role.permissions" :key="permission" class="flex items-center text-xs sm:text-sm text-gray-700 whitespace-nowrap">
                                                <input
                                                    type="checkbox"
                                                    class="form-checkbox h-3 w-3 sm:h-4 sm:w-4 text-[#0A97B0] border-gray-300 rounded mr-1"
                                                    :checked="role.name === 'Guest' && permission === 'View'"
                                                />
                                                {{ permission }}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Add any specific styles here if needed, or rely on Tailwind CSS utilities */
.bg-right-center {
  background-position: right 0.5rem center;
}

.appearance-none {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
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
.hover\:bg-gray-50:hover {
  background-color: #f9fafb;
}

/* Focus states for accessibility */
.focus\:ring-1:focus {
  box-shadow: 0 0 0 1px rgba(10, 151, 176, 0.5);
}

.focus\:ring-2:focus {
  box-shadow: 0 0 0 2px rgba(10, 151, 176, 0.5);
}

/* Smooth transitions */
.transition-colors {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 150ms;
}
</style>