<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const sidebarVisible = ref(true);
function toggleSidebar() {
  sidebarVisible.value = !sidebarVisible.value
}

const userMenuOpen = ref(false);

</script>

<template>
  <div class="bg-gray-100 min-h-screen flex relative">
    <!-- Sidebar -->
    <aside :class="sidebarVisible ? 'w-64' : 'w-12'"
      class="bg-white shadow-md p-4 transition-all duration-300 relative overflow-hidden">

      <div class="flex items-center justify-between">
        <!-- Logo -->
        <div v-if="sidebarVisible" class="text-xl font-bold">
          <div class="flex shrink-0 items-center">
            <Link :href="route('dashboard')">
            <ApplicationLogo class="block h-8 w-auto max-w-[130px] fill-current" />
            </Link>
          </div>
        </div>

        <!-- Toggle button -->
        <button @click="toggleSidebar" class="bg-white border rounded-full p-1 shadow hover:bg-gray-200">
          <svg v-if="sidebarVisible" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600"
            viewBox="0 0 20 20" fill="currentColor">
            <!-- Minus icon -->
            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" viewBox="0 0 20 20"
            fill="currentColor">
            <!-- Minus icon -->
            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>


      <!-- Sidebar content -->
      <div v-if="sidebarVisible" class="mt-6">
        <ul class="space-y-2">

          <!-- Dashboard -->
          <li>
            <a href="#" class="block py-2 px-3 flex items-center justify-between font-semibold text-sm text-gray-700 hover:text-teal-600 hover:bg-[#5BD1D7]/10 rounded transition-colors duration-200">

              <span>Dashboard</span>

              <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </a>
          </li>

          <!-- User Management -->
          <li>
            <div @click="userMenuOpen = !userMenuOpen"
              class="cursor-pointer py-2 px-3 text-sm flex justify-between items-center text-gray-700 hover:bg-gray-100 rounded">
              <span>User Management</span>
              <svg class="w-4 h-4 transform transition-transform duration-300" :class="{ 'rotate-90': userMenuOpen }"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition enter-active-class="transition duration-300 ease-out" enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-40" leave-active-class="transition duration-300 ease-in"
              leave-from-class="opacity-100 max-h-40" leave-to-class="opacity-0 max-h-0">
              <ul v-show="userMenuOpen" class="ml-5 mt-1 space-y-1 overflow-hidden">
                <li class="py-2">
                  <a href="#" class="block text-sm text-gray-600 hover:text-teal-700">User List</a>
                </li>
                <li>
                  <a href="#" class="block text-sm text-gray-600 hover:text-teal-700">Create New User</a>
                </li>
              </ul>
            </transition>
          </li>

        </ul>
      </div>


    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

      <!-- Topbar -->
      <header class="bg-white shadow-md p-4 flex justify-between items-center">
        <!-- Left: Search Input -->
        <div class="flex items-center w-full max-w-xs relative">
          <svg class="absolute left-3 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor"
            stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z" />
          </svg>
          <input type="text" placeholder="Search..."
            class="w-full border-gray-200 rounded pl-9 pr-3 py-1 text-sm focus:outline-none" />
        </div>


        <!-- Right: Actions -->
        <div class="flex items-center space-x-4 ml-4">
          <!-- Create Button -->
          <button class="bg-white text-dark px-3 py-1.5 rounded hover:bg-gray-100 text-sm">
            + Create
          </button>

          <!-- Language Selector -->
          <div class="relative">
            <select
              class="appearance-none border-0 rounded px-3 py-1 text-sm focus:outline-none pr-7 bg-white [&::-ms-expand]:hidden firefox:appearance-none">
              <option>English</option>
              <option>Bangla</option>
            </select>
          </div>


          <!-- Notification Icon -->
          <button class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20"
              fill="currentColor">
              <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a2 2 0 002-2H8a2 2 0 002 2z" />
            </svg>
            <!-- Optional: notification dot -->
            <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-500 rounded-full"></span>
          </button>

          <!-- Auth User Photo with Dropdown -->
          <div class="relative group">
            <img src="https://via.placeholder.com/32" alt="User" class="w-8 h-8 rounded-full border cursor-pointer" />
            <!-- Dropdown (show on hover or click - simple hover demo here) -->
            <!-- <div
              class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-50">
              <div class="p-2 text-sm">
                <p class="font-semibold">John Doe</p>
                <p class="text-gray-500">john@example.com</p>
              </div>
              <div class="border-t">
                <a href="#" class="block px-3 py-2 text-sm hover:bg-gray-100">Profile</a>
                <a href="#" class="block px-3 py-2 text-sm hover:bg-gray-100">Logout</a>
              </div>
            </div> -->
          </div>
        </div>
      </header>


      <!-- Main Section -->
      <main class="p-6">
        <slot />
      </main>
    </div>
  </div>
</template>
