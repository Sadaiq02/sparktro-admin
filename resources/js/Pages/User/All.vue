<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    customers: Object,
});

const search = ref('');
const selectedUsers = ref([]);

const filteredCustomers = computed(() => {
    if (!props.customers) return [];
    if (!search.value) return props.customers;
    
    return props.customers.filter(customer => 
        customer.name.toLowerCase().includes(search.value.toLowerCase()) ||
        customer.email.toLowerCase().includes(search.value.toLowerCase()) ||
        customer.phone?.toLowerCase().includes(search.value.toLowerCase()) ||
        customer.country?.toLowerCase().includes(search.value.toLowerCase())
    );
});

const toggleUserSelection = (userId) => {
    const index = selectedUsers.value.indexOf(userId);
    if (index > -1) {
        selectedUsers.value.splice(index, 1);
    } else {
        selectedUsers.value.push(userId);
    }
};

const selectAllUsers = (event) => {
    if (event.target.checked) {
        selectedUsers.value = filteredCustomers.value.map(user => user.id);
    } else {
        selectedUsers.value = [];
    }
};
</script>

<template>
    <Head title="Customer List" />

    <AuthenticatedLayout>
        <div class="p-4 sm:p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-4 sm:px-6 py-4 sm:py-6 border-b border-gray-200 bg-gray-50 gap-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Customer List</h2>
                        <span v-if="selectedUsers.length > 0" class="text-sm text-gray-600 bg-gray-200 px-2 py-1 rounded">
                            {{ selectedUsers.length }} selected
                        </span>
                    </div>
                    <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
                        <!-- Search Input -->
                        <div class="relative flex-1 sm:flex-none">
                            <input 
                                v-model="search"
                                type="text" 
                                placeholder="Search customers..." 
                                class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                            >
                            <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <Link 
  href="/users/create" 
  class="px-4 py-2 bg-[#0A97B0] hover:bg-[#088399] text-sm rounded text-white whitespace-nowrap transition-colors"
>    + Add User
                        </Link>
                    </div>
                </div>

                <!-- Mobile Card View -->
                <div class="block sm:hidden">
                    <div class="p-4 space-y-4">
                        <div v-for="customer in filteredCustomers" :key="customer.id" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <input 
                                        type="checkbox" 
                                        :checked="selectedUsers.includes(customer.id)"
                                        @change="toggleUserSelection(customer.id)"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                    >
                                    <img :src="customer.image" alt="avatar" class="w-12 h-12 rounded-full object-cover" />
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 p-1">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <div class="font-medium text-gray-900 text-base">{{ customer.name }}</div>
                                    <div class="text-sm text-gray-500">{{ customer.email }}</div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Phone:</span>
                                        <span class="ml-1 text-gray-900">{{ customer.phone || 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Country:</span>
                                        <span class="ml-1 text-gray-900">{{ customer.country || 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Department:</span>
                                        <span class="ml-1 text-gray-900">{{ customer.department || 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Role:</span>
                                        <span class="ml-1 text-gray-900">{{ customer.role || 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-2">
                                    <span class="text-xs text-gray-500">{{ customer.date }}</span>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium"
                                          :class="customer.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                                        {{ customer.status }}
                                    </span>
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
                                        :checked="selectedUsers.length === filteredCustomers.length && filteredCustomers.length > 0"
                                        @change="selectAllUsers"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                    />
                                </th>
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Customer Name</th>
                                <th class="px-4 py-3 hidden md:table-cell">Phone</th>
                                <th class="px-4 py-3 hidden lg:table-cell">Country</th>
                                <th class="px-4 py-3 hidden xl:table-cell">Department</th>
                                <th class="px-4 py-3 hidden lg:table-cell">Date</th>
                                <th class="px-4 py-3 hidden xl:table-cell">Role</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="customer in filteredCustomers" :key="customer.id" class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <input 
                                        type="checkbox" 
                                        :checked="selectedUsers.includes(customer.id)"
                                        @change="toggleUserSelection(customer.id)"
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"
                                    />
                                </td>

                                <td class="px-4 py-3">
                                    <img :src="customer.image" alt="avatar" class="w-8 h-8 rounded-full object-cover" />
                                </td>

                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-800">{{ customer.name }}</div>
                                    <div class="text-xs text-gray-500">{{ customer.email }}</div>
                                </td>

                                <td class="px-4 py-3 hidden md:table-cell">{{ customer.phone || 'N/A' }}</td>                                
                                <td class="px-4 py-3 hidden lg:table-cell">{{ customer.country || 'N/A' }}</td>
                                <td class="px-4 py-3 hidden xl:table-cell">{{ customer.department || 'N/A' }}</td>
                                <td class="px-4 py-3 hidden lg:table-cell">{{ customer.date }}</td>
                                <td class="px-4 py-3 hidden xl:table-cell">{{ customer.role || 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium"
                                          :class="customer.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                                        {{ customer.status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button class="text-gray-500 hover:text-gray-700 p-1 rounded hover:bg-gray-100">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div v-if="filteredCustomers.length === 0" class="p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 01 3-3.87m9-4a4 4 0 1 0-8 0 4 4 0 0 0 8 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No customers found</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ search ? 'Try adjusting your search terms.' : 'Get started by creating a new customer.' }}
                    </p>
                    <div class="mt-6">
                        <Link href="/users/create" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700">
                            + Add Customer
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>