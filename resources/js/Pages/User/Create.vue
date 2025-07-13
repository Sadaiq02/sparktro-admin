<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    image: null,
    username: '',
    user_id: '',
    email: '',
    phone: '',
    join_date: '',
    country: '',
    department: '',
    role: '',
    address: '',
    gender: '',
    languages: '',
    duty_schedule: '',
    password: '',
    designation: '',
});

const showPassword = ref(false);

// Submit form
function onSubmit() {
    form.post('/users/store', {
        form: true,
        onSuccess: () => {
            // optional: reset form or show success
            form.reset()
        }
    })
}

</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <div class="p-4 sm:p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 sm:py-6 border-b border-gray-200 bg-gray-50 gap-4">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Create New User</h2>

                </div>

                <div class="p-4 sm:p-6">
                    <!-- Form -->
                    <form class="space-y-6" @submit.prevent="onSubmit()">
                        <!-- Personal Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Personal Information</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">User Name *</label>
                                    <input 
                                        type="text" 
                                        v-model="form.username" 
                                        placeholder="Enter user name"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        required
                                    />
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">User ID *</label>
                                    <input 
                                        type="text" 
                                        v-model="form.user_id" 
                                        placeholder="Enter user ID"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        required
                                    />
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input 
                                        type="email" 
                                        v-model="form.email" 
                                        placeholder="example@gmail.com"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                        required
                                    />
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input 
                                        type="tel" 
                                        v-model="form.phone" 
                                        placeholder="Phone number"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    />
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Joining Date</label>
                                    <input 
                                        type="date" 
                                        v-model="form.join_date"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    />
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                    <select 
                                        v-model="form.country"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Country</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                            </select>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Additional Information</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                                    <select 
                                        v-model="form.languages"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Language</option>
                                <option value="English">English</option>
                                <option value="Bangla">Bangla</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="French">French</option>
                            </select>
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                    <select 
                                        v-model="form.gender"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                                    <select 
                                        v-model="form.department"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Department</option>
                                        <option value="Management">Management</option>
                                        <option value="Accounts">Accounts</option>
                                        <option value="IT">IT</option>
                                        <option value="HR">HR</option>
                                        <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                                    <select 
                                        v-model="form.designation"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Designation</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Coordinator">Coordinator</option>
                            </select>
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                    <select 
                                        v-model="form.role"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                        <option value="User">User</option>
                            </select>
                        </div>
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Duty Schedule</label>
                                    <input 
                                        type="text" 
                                        v-model="form.duty_schedule" 
                                        placeholder="e.g., 9 AM - 5 PM"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Address Information</h3>
                            
                            <div class="grid grid-cols-1 gap-4">
                        <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <textarea 
                                        v-model="form.address" 
                                        placeholder="Enter full address"
                                        rows="3"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Security Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">Security</h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="relative">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                                    <div class="relative">
                                        <input 
                                            :type="showPassword ? 'text' : 'password'" 
                                            v-model="form.password" 
                                            placeholder="Enter password"
                                            class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                            required
                                        />
                                        <button
                                            type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700"
                                        >
                                            <svg v-if="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.958 9.958 0 012.766-4.316m1.914-1.4A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.982 9.982 0 01-4.254 5.616M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                            <button 
                                type="submit" 
                                :disabled="form.processing"
                                class="px-6 py-3 bg-[#0A97B0] text-sm rounded-lg font-semibold text-white shadow hover:bg-[#09879b] transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            >
                                <svg v-if="form.processing" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ form.processing ? 'Creating User...' : 'Create User' }}
                            </button>
                            <Link 
                                href="/users/all" 
                                class="px-6 py-3 bg-gray-100 text-sm rounded-lg font-semibold text-gray-700 hover:bg-gray-200 transition flex items-center justify-center"
                            >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                                Cancel
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>