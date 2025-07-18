<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const selectedFileName = ref('image.jpg');

const form = useForm({
  image: null,
  username: '',
  user_id: '',
  email: '',
  phone: '',
  join_date: '',
  country: '',
  department: '',
  designation: '',
  role: '',
  address: '',
  gender: '',
  language: '',
  duty_schedule: '',
  password: '',
});

// Get user data from props or route parameters
const props = defineProps({
  user: {
    type: Object,
    required: false,
    default: null
  }
});

// Populate form with user data when component mounts
onMounted(() => {
  if (props.user) {
    form.username = props.user.name || props.user.username || '';
    form.user_id = props.user.user_id || props.user.userId || '';
    form.email = props.user.email || '';
    form.phone = props.user.phone || '';
    form.join_date = props.user.join_date || props.user.joiningDate || '';
    form.country = props.user.country || '';
    form.department = props.user.department || '';
    form.designation = props.user.designation || props.user.department || ''; // Using department as designation for now
    form.role = props.user.role || '';
    form.address = props.user.address || '';
    form.gender = props.user.gender || '';
    form.language = props.user.language || 'English'; // Default value
    form.duty_schedule = props.user.duty_schedule || props.user.dutySchedule || '';
    form.password = props.user.password || '';
    
    // Set the selected file name if there's an image
    if (props.user.image) {
      selectedFileName.value = props.user.image.split('/').pop() || 'image.jpg';
    }
  }
});

const handleFile = (e) => {
  const file = e.target.files[0];
  form.image = file;
  selectedFileName.value = file ? file.name : 'No File Selected';
};

const triggerFileInput = () => {
  document.getElementById('file-input').click();
};

function onSubmit() {
  if (!props.user || !props.user.id) {
    console.error('User ID not available');
    return;
  }
  
  form.put(`/users/${props.user.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      // Redirect back to the users list after successful update
      window.location.href = '/users/all';
    },
    onError: (errors) => {
      console.error('Update failed:', errors);
    }
  });
}
</script>

<template>
  <Head title="Edit User" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
          <!-- Header -->
          <div class="flex items-center justify-between border-b px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-800">Edit User</h2>
            <Link href="/users/all">
              <button
                class="flex items-center gap-1 border border-gray-300 text-gray-700 bg-white hover:bg-gray-100 text-sm px-4 py-1.5 rounded-md transition">
                ✕ Cancel
              </button>
            </Link>
          </div>

          <!-- Form -->
          <form @submit.prevent="onSubmit" class="px-6 py-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
            <!-- Row 1 -->
            <div class="form-group">
              <label>User Name</label>
              <input v-model="form.username" type="text" placeholder="Full Name" class="form-input" />
            </div>
            <div class="form-group">
              <label>User ID</label>
              <input v-model="form.user_id" type="text" placeholder="User ID" class="form-input" />
            </div>
            <div class="form-group">
              <label>Email</label>
              <input v-model="form.email" type="email" placeholder="example@gmail.com" class="form-input" />
            </div>

            <!-- Row 2 -->
            <div class="form-group">
              <label>Phone</label>
              <input v-model="form.phone" type="text" placeholder="Phone Number" class="form-input" />
            </div>
            <div class="form-group">
              <label>Joining Date</label>
              <input v-model="form.join_date" type="date" class="form-input" />
            </div>
            <div class="form-group">
              <label>Country</label>
              <select v-model="form.country" class="form-input">
                <option disabled value="">Select Country</option>
                <option>Nigeria</option>
                <option>USA</option>
                <option>India</option>
                <option>Saudi Arabia</option>
                <option>South Africa</option>
                <option>Viet Nam</option>
                <option>Bahrain</option>
                <option>Iceland</option>
                <option>Algeria</option>
                <option>Afghanistan</option>
                <option>Haiti</option>
                <option>Saint Barthélemy</option>
              </select>
            </div>

            <!-- Row 3 -->
            <div class="form-group">
              <label>Language</label>
              <select v-model="form.language" class="form-input">
                <option disabled value="">Select Language</option>
                <option>English</option>
                <option>French</option>
              </select>
            </div>
            <div class="form-group">
              <label>Address</label>
              <input v-model="form.address" type="text" placeholder="Address" class="form-input" />
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select v-model="form.gender" class="form-input">
                <option disabled value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>

            <!-- Row 4 -->
            <div class="form-group">
              <label>Department</label>
              <select v-model="form.department" class="form-input">
                <option disabled value="">Select Department</option>
                <option>HR</option>
                <option>Development</option>
                <option>Manager</option>
                <option>Management</option>
                <option>Account</option>
                <option>Designer</option>
              </select>
            </div>
            <div class="form-group">
              <label>Designation</label>
              <input v-model="form.designation" type="text" placeholder="e.g. Manager" class="form-input" />
            </div>
            <div class="form-group">
              <label>Role</label>
              <select v-model="form.role" class="form-input">
                <option disabled value="">Select Role</option>
                <option>Admin</option>
                <option>Super Admin</option>
                <option>HR</option>
                <option>Staff</option>
                <option>Employee</option>
              </select>
            </div>

            <!-- Row 5 -->
            <div class="form-group">
              <label>User Image (100px × 100px)</label>
              <div class="relative">
                <div class="flex items-center border border-gray-300 rounded-md bg-white">
                  <button 
                    type="button"
                    @click="triggerFileInput"
                    class="flex items-center gap-1 px-3 py-2 text-gray-700 text-sm border-r border-gray-300 hover:bg-gray-50 transition">
                    
                    Browse...
                  </button>
                  <span class="flex-1 px-3 py-2 text-sm text-gray-500">{{ selectedFileName }}</span>
                  <div class="px-3 py-2">
                    <img src="/assets/A down.svg" alt="Browse" class="w-4 h-4" />
                   
                  </div>
                </div>
                <input 
                  id="file-input"
                  type="file" 
                  @change="handleFile" 
                  class="hidden" 
                  accept="image/*" />
              </div>
            </div>
            <div class="form-group">
              <label>Duty Schedule</label>
              <div class="relative">
                <input v-model="form.duty_schedule" type="text" placeholder="e.g. 9:00 AM - 5:00 PM" class="form-input pr-10" />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input v-model="form.password" type="password" placeholder="Password" class="form-input" />
            </div>

            <!-- Submit Button -->
            <div class="col-span-1 md:col-span-2 lg:col-span-3 flex justify-start pt-4">
              <button type="submit"
                class="bg-[#0A97B0] hover:bg-[#098aa0] text-white text-sm px-6 py-2 rounded-md transition">
                Update User
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.form-group {
  @apply flex flex-col;
}
.form-group label {
  @apply mb-1 text-xs font-medium text-gray-700;
}
.form-input {
  @apply w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0A97B0] bg-white;
}
</style>
