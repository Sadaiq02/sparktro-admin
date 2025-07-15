<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const sidebarVisible = ref(true);
const mobileMenuOpen = ref(false);
const isMobile = computed(() => window.innerWidth < 768);

function toggleSidebar() {
  sidebarVisible.value = !sidebarVisible.value;
}

function toggleMobileMenu() {
  mobileMenuOpen.value = !mobileMenuOpen.value;
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

function closeSidebar() {
  if (isMobile.value) {
    sidebarVisible.value = false;
  }
}

// Sidebar logic: always show icons for all screens, expand on hover/touch for all screens
const hoverSidebar = ref(false);
const sidebarCollapsed = ref(false);
const windowWidth = ref(window.innerWidth);

const isLargeScreen = computed(() => windowWidth.value >= 1024);
const isMediumScreen = computed(() => windowWidth.value >= 768 && windowWidth.value < 1024);
const isSmallScreen = computed(() => windowWidth.value < 768);

const sidebarOpen = computed(() => {
  // Always expand on hover/touch for all screens
  if (isLargeScreen.value) return !sidebarCollapsed.value || hoverSidebar.value;
  return hoverSidebar.value;
});

function toggleSidebarDesktop() {
  if (isLargeScreen.value) {
    sidebarCollapsed.value = !sidebarCollapsed.value;
  }
}

const handleResize = () => {
  windowWidth.value = window.innerWidth;
  if (isLargeScreen.value) {
    sidebarCollapsed.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', closeProfileDropdown);
  window.addEventListener('resize', handleResize);
  handleResize();
});

onBeforeUnmount(() => {
  document.removeEventListener('click', closeProfileDropdown);
  window.removeEventListener('resize', handleResize);
});
</script>

<template>
    <div class="min-h-screen flex relative" style="background-color: var(--color-gray)">
    <!-- Sidebar Hover Zone for all screens -->
    <div ref="sidebarHoverZone" class="fixed top-0 left-0 h-full w-4 z-50" style="background: transparent;"></div>
    
    <!-- Sidebar -->
    <aside ref="sidebarRef"
      @mouseenter="hoverSidebar.value = true"
      @mouseleave="hoverSidebar.value = false"
      @touchstart="hoverSidebar.value = true"
      @touchend="hoverSidebar.value = false"
      :class="[
        sidebarOpen ? 'w-[var(--sidebar-width)]' : 'w-[var(--sidebar-collapsed-width)]',
        'bg-white border-r border-gray-200 h-screen overflow-y-auto transition-all duration-300',
        'ease-in-out',
      ]"
    >
      <!-- Logo area -->
      <div class="logo-area flex items-center justify-between h-[var(--header-height)] px-6 py-2.5 border-b border-gray-200">
        <div v-if="sidebarOpen" class="text-xl font-bold">
          <div class="flex shrink-0 items-center">
            <Link :href="route('dashboard')">
              <ApplicationLogo class="block h-12 w-auto max-w-[130px] fill-current" />
            </Link>
          </div>
        </div>
        <div v-else class="flex items-center justify-center w-full">
          <Link :href="route('dashboard')">
            <ApplicationLogo class="block h-10 w-auto max-w-[40px] fill-current" />
          </Link>
        </div>
        <!-- Desktop toggle button -->
        <button v-if="isLargeScreen" @click="toggleSidebarDesktop" :class="{ 'mr-2': sidebarCollapsed }" class="bg-white border rounded-full p-1 shadow hover:bg-gray-100 ml-2">
          <svg v-if="!sidebarCollapsed" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
          </svg>
        </button>
      </div>
      <!-- Sidebar content -->
      <div v-if="sidebarOpen" class="mt-6 px-2">
        <ul class="space-y-1">
          <!-- Dashboard -->
          <li>
            <Link href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">grid_view</i>
              Dashboard
            </Link>
          </li>

          <!-- User Management -->
          <li>
            <div @click="userMenuOpen = !userMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': userMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]" :class="{ 'text-[var(--color-primary)]': userMenuOpen }">group</i>
              <span class="hidden sm:inline">User Management</span>
              <span class="sm:hidden">Users</span>
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[var(--color-primary)]': userMenuOpen, 'text-gray-400': !userMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition 
              enter-active-class="transition-all duration-300 ease-in-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-[500px]"
              leave-active-class="transition-all duration-300 ease-in-out"
              leave-from-class="opacity-100 max-h-[500px]"
              leave-to-class="opacity-0 max-h-0">
              <ul v-show="userMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden border-l-2 border-[var(--color-primary)] pl-3">
                <li>
                  <Link href="/users/all" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    List Users
                  </Link>
                </li>
                <li>
                  <Link href="/users/create" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Create New User
                  </Link>
                </li>
              </ul>
            </transition>
          </li>

          <!-- Roles & Permissions -->
          <li>
            <div @click="rolePermissionMenuOpen = !rolePermissionMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': rolePermissionMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]" :class="{ 'text-[var(--color-primary)]': rolePermissionMenuOpen }">manage_accounts</i>
              <span class="hidden sm:inline">Role & Permission</span>
              <span class="sm:hidden">Roles</span>
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[var(--color-primary)]': rolePermissionMenuOpen, 'text-gray-400': !rolePermissionMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition 
              enter-active-class="transition-all duration-300 ease-in-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-[500px]"
              leave-active-class="transition-all duration-300 ease-in-out"
              leave-from-class="opacity-100 max-h-[500px]"
              leave-to-class="opacity-0 max-h-0">
              <ul v-show="rolePermissionMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden border-l-2 border-[var(--color-primary)] pl-3">
                <li class="py-1">
                  <Link href="/role/all" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Role
                  </Link>
                </li>
                <li class="py-1">
                  <Link href="/role/assign" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Assign Role & Permissions
                  </Link>
                </li>
              </ul>
            </transition>
          </li>

          <!-- Activity Logs -->
          <li>
            <Link href="/activity/logs" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">history</i>
              <span class="hidden sm:inline">Activity Logs</span>
              <span class="sm:hidden">Logs</span>
            </Link>
          </li>

          <!-- Profile Management -->
          <li>
            <div @click="profileMenuOpen = !profileMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': profileMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]" :class="{ 'text-[var(--color-primary)]': profileMenuOpen }">person</i>
              <span class="hidden sm:inline">Profile Management</span>
              <span class="sm:hidden">Profile</span>
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[var(--color-primary)]': profileMenuOpen, 'text-gray-400': !profileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition 
              enter-active-class="transition-all duration-300 ease-in-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-[500px]"
              leave-active-class="transition-all duration-300 ease-in-out"
              leave-from-class="opacity-100 max-h-[500px]"
              leave-to-class="opacity-0 max-h-0">
              <ul v-show="profileMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden border-l-2 border-[var(--color-primary)] pl-3">
                <li>
                  <Link href="/profile" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Profile
                  </Link>
                </li>
                <li>
                  <Link href="/profile" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Change Password
                  </Link>
                </li>
              </ul>
            </transition>
          </li>

          <!-- Notifications -->
          <li>
            <div @click="notificationMenuOpen = !notificationMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': notificationMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]" :class="{ 'text-[var(--color-primary)]': notificationMenuOpen }">notifications</i>
              <span class="hidden sm:inline">Notifications</span>
              <span class="sm:hidden">Notifs</span>
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[var(--color-primary)]': notificationMenuOpen, 'text-gray-400': !notificationMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition 
              enter-active-class="transition-all duration-300 ease-in-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-[500px]"
              leave-active-class="transition-all duration-300 ease-in-out"
              leave-from-class="opacity-100 max-h-[500px]"
              leave-to-class="opacity-0 max-h-0">
              <ul v-show="notificationMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden border-l-2 border-[var(--color-primary)] pl-3">
                <li>
                  <Link href="/notifications/push" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Push Notifications
                  </Link>
                </li>
                <li>
                  <Link href="/notifications/push/create" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    Create Push Notification
                  </Link>
                </li>
                <li>
                  <Link href="/notifications/general" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': false }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    General Notifications
                  </Link>
                </li>
              </ul>
            </transition>
          </li>

          <!-- Settings -->
          <li>
            <div @click="settingsMenuOpen = !settingsMenuOpen" tabindex="0" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm cursor-pointer transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': settingsMenuOpen }">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]" :class="{ 'text-[var(--color-primary)]': settingsMenuOpen }">settings</i>
              <span class="hidden sm:inline">Settings</span>
              <span class="sm:hidden">Settings</span>
              <svg class="ml-auto w-4 h-4 transition-transform duration-300" :class="{ 'rotate-90 text-[var(--color-primary)]': settingsMenuOpen, 'text-gray-400': !settingsMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>

            <transition 
              enter-active-class="transition-all duration-300 ease-in-out"
              enter-from-class="opacity-0 max-h-0"
              enter-to-class="opacity-100 max-h-[500px]"
              leave-active-class="transition-all duration-300 ease-in-out"
              leave-from-class="opacity-100 max-h-[500px]"
              leave-to-class="opacity-0 max-h-0">
              <ul v-show="settingsMenuOpen" class="ml-8 mt-1 space-y-1 overflow-hidden border-l-2 border-[var(--color-primary)] pl-3">
                <li>
                  <Link href="/settings" class="flex items-center gap-2 px-2 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)]" :class="{ 'bg-[var(--color-primary-hover)] text-[var(--color-primary)]': $page.url.startsWith('/settings') }">
                    <span class="w-1 h-1 rounded-full bg-[var(--color-primary)] mr-2"></span>
                    General Setting
                  </Link>
                </li>
              </ul>
            </transition>
          </li>

          <!-- Logout -->
          <li>
            <a href="#" @click.prevent="$inertia.post('/logout')" class="flex items-center gap-3 px-4 py-2 rounded-lg font-semibold text-sm transition-colors duration-200 hover:bg-[var(--color-primary-hover)] hover:text-[var(--color-primary)] group">
              <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">logout</i>
              <span class="hidden sm:inline">Logout</span>
              <span class="sm:hidden">Logout</span>
            </a>
          </li>
        </ul>
      </div>
      <div v-else class="mt-6 flex flex-col items-center space-y-4">
        <!-- Collapsed sidebar icons, always visible for all screens -->
        <Link href="/dashboard" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Dashboard">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">grid_view</i>
        </Link>
        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="User Management">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">group</i>
        </button>
        <Link href="/role/all" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Role">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">manage_accounts</i>
        </Link>
        <Link href="/role/assign" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Assign Role & Permissions">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">assignment_turned_in</i>
        </Link>
        <Link href="/activity/logs" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Activity Logs">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">history</i>
        </Link>
        <button @click="profileMenuOpen = !profileMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Profile Management">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">person</i>
        </button>
        <button @click="notificationMenuOpen = !notificationMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Notifications">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">notifications</i>
        </button>
        <button @click="settingsMenuOpen = !settingsMenuOpen" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Settings">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">settings</i>
        </button>
        <button @click.prevent="$inertia.post('/logout')" class="flex items-center justify-center w-10 h-10 rounded-lg hover:bg-[var(--color-primary-hover)] group" title="Logout">
          <i class="material-icons-outlined text-[22px] group-hover:text-[var(--color-primary)]">logout</i>
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen">
      <!-- Top bar -->
      <header class="fixed top-0 left-0 right-0 bg-white shadow-sm h-auto min-h-[var(--header-height)] px-2 py-3 flex flex-wrap items-center border-b border-gray-200 z-50 transition-all duration-300 gap-y-2"
        :style="sidebarOpen ? `left: var(--sidebar-width)` : `left: var(--sidebar-collapsed-width)`">
        <!-- Search Input -->
        <div class="flex-1 min-w-[120px] max-w-[350px] flex items-center relative w-full sm:w-auto gap-2 order-2 sm:order-1">
          <svg class="absolute left-4 w-4 h-4 text-gray-400 pointer-events-none" fill="none"
            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z" />
          </svg>
          <input type="text" placeholder="Search..."
            class="w-full h-[40px] py-[12px] pr-[16px] pl-[40px] border border-gray-200 rounded-[var(--border-radius)] focus:outline-none focus:ring-1 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] text-sm" />
        </div>
        <!-- Right Actions -->
        <div class="flex items-center flex-shrink-0 gap-2 sm:gap-4 ml-auto order-3">
          <!-- Language Selector -->
          <div class="relative hidden sm:block">
            <select class="appearance-none border-0 rounded px-3 py-1 text-sm focus:outline-none pr-7 bg-white [&::-ms-expand]:hidden">
              <option value="en">English</option>
              <option value="bd">Bangla</option>
            </select>
          </div>
          <!-- Notification Icon -->
          <button class="relative text-gray-600 p-2 rounded-md hover:bg-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a2 2 0 002-2H8a2 2 0 002 2z" />
            </svg>
            <span class="absolute top-1 right-1 inline-block w-2 h-2 bg-[var(--color-red)] rounded-full"></span>
          </button>
          <!-- User Avatar -->
          <div class="relative profile-dropdown">
            <div class="w-8 h-8 rounded-full bg-[var(--color-primary)] flex items-center justify-center text-white font-bold cursor-pointer" @click="toggleProfileDropdown">
              JD
            </div>
            <div v-if="profileDropdownOpen" class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-md z-50">
              <div class="p-2 text-sm">
                <p class="font-semibold text-[var(--color-black)]">John Doe</p>
                <p class="text-[var(--color-black-light)]">john@example.com</p>
              </div>
              <div class="border-t border-gray-200">
                <Link href="/profile" class="block px-3 py-2 text-sm hover:bg-[var(--color-gray)]">Profile</Link>
                <Link href="/logout" method="post" as="button" class="block px-3 py-2 text-sm hover:bg-[var(--color-gray)] w-full text-left">Logout</Link>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Main Section -->
      <main class="p-4 sm:p-6 bg-[var(--color-gray)] mt-[var(--header-height)] flex-1 overflow-y-auto scroll-smooth">
        <slot />
      </main>
    </div>
  </div>
</template>