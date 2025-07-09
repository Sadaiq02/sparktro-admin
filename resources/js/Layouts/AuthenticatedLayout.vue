<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
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
const rolePermissionMenuOpen = ref(false);
const profileMenuOpen = ref(false);
const notificationMenuOpen = ref(false);
const settingsMenuOpen = ref(false);

// Profile dropdown logic
const profileDropdownOpen = ref(false);
function toggleProfileDropdown() {
  profileDropdownOpen.value = !profileDropdownOpen.value;
}
function closeProfileDropdown(e) {
  if (!e.target.closest('.profile-dropdown')) {
    profileDropdownOpen.value = false;
  }
}
onMounted(() => {
  document.addEventListener('click', closeProfileDropdown);
});
onBeforeUnmount(() => {
  document.removeEventListener('click', closeProfileDropdown);
});
</script>

<template>
    <div class="bg-gray-sparktro min-h-screen flex relative">
    <!-- Sidebar -->
        <aside :class="sidebarVisible ? 'w-[260px]' : 'w-12'" class="bg-white border-r border-gray-200 h-screen overflow-y-auto transition-all duration-300">

            <!-- Logo area -->
            <div class="logo-area flex items-center justify-between h-[68px] px-6 py-2.5 border-b border-gray-200">
        <div v-if="sidebarVisible" class="text-xl font-bold">
          <div class="flex shrink-0 items-center">
            <Link :href="route('dashboard')">
                        <ApplicationLogo class="block h-12 w-auto max-w-[130px] fill-current" />
            </Link>
          </div>
        </div>

                <!-- Toggle button with right margin when collapsed -->
                <button @click="toggleSidebar" :class="{ 'mr-2': !sidebarVisible }" class="bg-white border rounded-full p-1 shadow hover:bg-gray-100">
                    <svg v-if="sidebarVisible" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
            viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
          </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
            fill="currentColor">
                        <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
          </svg>
        </button>
      </div>

      <!-- Sidebar content -->
            <div v-if="sidebarVisible" class="mt-6 px-2">
                <ul class="space-y-1">
          <!-- Dashboard -->
          <li>
            <Link href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group" :class="{ 'bg-[#E6F7FA] text-[#0A97B0]': false }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">grid_view</i>
              Dashboard
            </Link>
          </li>

          <!-- User Management -->
          <li>
            <div @click="userMenuOpen = !userMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group" :class="{ 'bg-[#E6F7FA] text-[#0A97B0]': userMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]" :class="{ 'text-[#0A97B0]': userMenuOpen }">group</i>
              User Management
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[#0A97B0]': userMenuOpen, 'text-gray-400': !userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition enter-active-class="transition duration-150 ease-out"
                enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-40"
                leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100 max-h-40"
                leave-to-class="opacity-0 max-h-0">
              <ul v-show="userMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden">
                <li>
                  <Link href="/users/all" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">List Users</Link>
                </li>
                <li>
                  <Link href="/users/create" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">Create New User</Link>
                </li>
              </ul>
            </transition>
          </li>

                    <!-- Roles & Permissions -->
          <li>
            <div @click="rolePermissionMenuOpen = !rolePermissionMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group" :class="{ 'bg-[#E6F7FA] text-[#0A97B0]': rolePermissionMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]" :class="{ 'text-[#0A97B0]': rolePermissionMenuOpen }">manage_accounts</i>
              Role & Permission
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[#0A97B0]': rolePermissionMenuOpen, 'text-gray-400': !rolePermissionMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

                        <transition enter-active-class="transition duration-150 ease-out"
                            enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-40"
                            leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100 max-h-40"
                            leave-to-class="opacity-0 max-h-0">
              <ul v-show="rolePermissionMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden">
                <li class="py-2">
                                    <Link href="/role/all" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">Role</Link>
                </li>
                <li class="py-1">
                                    <Link href="/role/assign" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">Assign Role & Permissions</Link>
                </li>
              </ul>
            </transition>
                </li>
                <li>
                  <Link href="/activity/logs" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group">
                    <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">history</i>
                    Activity Logs
                  </Link>
                </li>
                <li>
                  <div @click="profileMenuOpen = !profileMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group" :class="{ 'bg-[#E6F7FA] text-[#0A97B0]': profileMenuOpen }">
                    <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]" :class="{ 'text-[#0A97B0]': profileMenuOpen }">person</i>
                    Profile Management
                    <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[#0A97B0]': profileMenuOpen, 'text-gray-400': !profileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                  <transition enter-active-class="transition duration-150 ease-out" enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-40" leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100 max-h-40" leave-to-class="opacity-0 max-h-0">
                    <ul v-show="profileMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden">
                      <li>
                        <Link href="/profile" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">Profile</Link>
                      </li>
                      <li>
                        <Link href="/profile" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">Change Password</Link>
                      </li>
                    </ul>
                  </transition>
                </li>
                <li>
                  <div @click="notificationMenuOpen = !notificationMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group" :class="{ 'bg-[#E6F7FA] text-[#0A97B0]': notificationMenuOpen }">
                    <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]" :class="{ 'text-[#0A97B0]': notificationMenuOpen }">notifications</i>
                    Notifications
                    <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[#0A97B0]': notificationMenuOpen, 'text-gray-400': !notificationMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                  <transition enter-active-class="transition duration-150 ease-out" enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-40" leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100 max-h-40" leave-to-class="opacity-0 max-h-0">
                    <ul v-show="notificationMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden">
                      <li>
                        <Link href="/notifications/general" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">General Notification</Link>
                      </li>
                      <li>
                        <Link href="/notifications/push" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">Push Notification</Link>
                      </li>
                    </ul>
                  </transition>
                </li>
                <li>
                  <div @click="settingsMenuOpen = !settingsMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group" :class="{ 'bg-[#E6F7FA] text-[#0A97B0]': settingsMenuOpen }">
                    <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]" :class="{ 'text-[#0A97B0]': settingsMenuOpen }">settings</i>
                    Settings
                    <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[#0A97B0]': settingsMenuOpen, 'text-gray-400': !settingsMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                  <transition enter-active-class="transition duration-150 ease-out" enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-40" leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100 max-h-40" leave-to-class="opacity-0 max-h-0">
                    <ul v-show="settingsMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden">
                      <li>
                        <Link href="/settings" class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] border-l-4" :class="{ 'bg-[#E6F7FA] text-[#0A97B0] border-[#0A97B0]': false, 'border-transparent': true }">General Setting</Link>
                      </li>
                    </ul>
                  </transition>
                </li>
                <li>
                  <a href="#" @click.prevent="$inertia.post('/logout')" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm transition-colors duration-200 hover:bg-[#E6F7FA] hover:text-[#0A97B0] group">
                    <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">logout</i>
                    Logout
                  </a>
                </li>
              </ul>
            </div>
    <div v-else class="mt-6 flex flex-col items-center space-y-4">
      <Link href="/dashboard" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Dashboard">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">grid_view</i>
      </Link>
      <button @click="userMenuOpen = !userMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="User Management">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">group</i>
      </button>
      <Link href="/role/all" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Role">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">manage_accounts</i>
      </Link>
      <Link href="/role/assign" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Assign Role & Permissions">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">assignment_turned_in</i>
      </Link>
      <Link href="/activity/logs" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Activity Logs">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">history</i>
      </Link>
      <button @click="profileMenuOpen = !profileMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Profile Management">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">person</i>
      </button>
      <button @click="notificationMenuOpen = !notificationMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Notifications">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">notifications</i>
      </button>
      <button @click="settingsMenuOpen = !settingsMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Settings">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">settings</i>
      </button>
      <button @click.prevent="$inertia.post('/logout')" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[#E6F7FA] group" title="Logout">
        <i class="material-icons-outlined text-[22px] group-hover:text-[#0A97B0]">logout</i>
      </button>
    </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen">
            <!-- Top bar -->
            <header class="bg-white shadow-sm h-[68px] px-2 py-8 flex justify-between items-center border-b border-gray-sparktro">
                <!-- Search Input -->
                <div class="flex items-center relative w-[300px] gap-[10px]">
                    <svg class="absolute left-4 w-4 h-4 text-black-sparktro/50 pointer-events-none" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z" />
          </svg>
          <input type="text" placeholder="Search..."
                        class="w-full h-[40px] py-[12px] pr-[16px] pl-[40px] border border-gray-sparktro rounded-[8px] focus:outline-none focus:ring-1 focus:ring-primary-sparktro focus:border-primary-sparktro">
        </div>

                <!-- Right Actions -->
        <div class="flex items-center space-x-4 ml-4">
          <!-- Language Selector -->
          <div class="relative">
            <select
                            class="appearance-none border-0 rounded px-3 py-1 text-sm focus:outline-none pr-7 bg-white [&::-ms-expand]:hidden">
                            <option value="en">English</option>
                            <option value="bd">Bangla</option>
            </select>
          </div>

          <!-- Notification Icon -->
                    <button class="relative text-black-sparktro">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a2 2 0 002-2H8a2 2 0 002 2z" />
            </svg>
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-sparktro rounded-full"></span>
          </button>

                    <!-- User Avatar -->
          <div class="relative profile-dropdown">
                        <div class="w-8 h-8 rounded-full bg-primary-sparktro flex items-center justify-center text-white font-bold cursor-pointer" @click="toggleProfileDropdown">
                            JD
                        </div>
                        <div v-if="profileDropdownOpen" class="absolute right-0 mt-2 w-40 bg-white border border-gray-sparktro rounded shadow-md z-50">
              <div class="p-2 text-sm">
                                <p class="font-semibold text-black-sparktro">John Doe</p>
                                <p class="text-black-sparktro/60">john@example.com</p>
                            </div>
                            <div class="border-t border-gray-sparktro">
                                <Link href="/profile" class="block px-3 py-2 text-sm hover:bg-gray-sparktro">Profile</Link>
                                <Link href="/logout" method="post" as="button" class="block px-3 py-2 text-sm hover:bg-gray-sparktro w-full text-left">Logout</Link>
              </div>
              </div>
          </div>
        </div>
      </header>

      <!-- Main Section -->
            <main class="p-6 bg-gray-sparktro">
        <slot />
      </main>
    </div>
  </div>
</template>
