<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const sidebarVisible = ref(true);
const mobileMenuOpen = ref(false);

// Menu states
const userMenuOpen = ref(false);
const rolePermissionMenuOpen = ref(false);
const profileMenuOpen = ref(false);
const notificationMenuOpen = ref(false);
const settingsMenuOpen = ref(false);

// Profile dropdown
const profileDropdownOpen = ref(false);
const toggleProfileDropdown = () => {
  profileDropdownOpen.value = !profileDropdownOpen.value;
};

// Close dropdowns when clicking outside
const closeDropdowns = (e) => {
  if (!e.target.closest('.profile-dropdown')) {
    profileDropdownOpen.value = false;
  }
};

// Toggle sidebar
const toggleSidebar = () => {
  sidebarVisible.value = !sidebarVisible.value;
};

// Handle responsive behavior
onMounted(() => {
  document.addEventListener('click', closeDropdowns);
  
  const handleResize = () => {
    if (window.innerWidth < 1024) {
      sidebarVisible.value = false;
    } else {
      sidebarVisible.value = true;
    }
  };
  
  window.addEventListener('resize', handleResize);
  handleResize();
  
  return () => {
    document.removeEventListener('click', closeDropdowns);
    window.removeEventListener('resize', handleResize);
  };
});
</script>

<template>
  <div class="min-h-screen bg-bg-light">
    <!-- Sidebar -->
    <aside :class="[
      'fixed inset-y-0 left-0 z-30 w-64 bg-bg-white border-r border-border-light transition-all duration-300 ease-in-out',
      sidebarVisible ? 'translate-x-0' : '-translate-x-full lg:translate-x-0 lg:w-20'
    ]">
      <!-- Logo -->
      <div class="h-16 flex items-center justify-between px-4 border-b border-border-light">
        <Link :href="route('dashboard')" class="flex items-center">
          <ApplicationLogo class="w-32 h-8" />
        </Link>
        <button @click="toggleSidebar" class="lg:hidden p-2 rounded-lg hover:bg-bg-lighter">
          <span class="material-icons-outlined">menu</span>
        </button>
      </div>

      <!-- Navigation -->
      <nav class="p-4 space-y-2">
        <Link :href="route('dashboard')" class="sidebar-link" :class="{ 'active': route().current('dashboard') }">
          <span class="material-icons-outlined">dashboard</span>
          <span :class="{ 'lg:hidden': !sidebarVisible }">Dashboard</span>
        </Link>

        <div>
          <button @click="userMenuOpen = !userMenuOpen" class="sidebar-link w-full text-left">
            <span class="material-icons-outlined">people</span>
            <span :class="{ 'lg:hidden': !sidebarVisible }">User Management</span>
            <span class="material-icons-outlined ml-auto" :class="{ 'rotate-90': userMenuOpen }">chevron_right</span>
          </button>
          <div v-show="userMenuOpen" class="pl-10 mt-2 space-y-2">
            <Link href="/users" class="sidebar-link">
              <span :class="{ 'lg:hidden': !sidebarVisible }">Users List</span>
            </Link>
          </div>
        </div>

        <Link href="/roles" class="sidebar-link">
          <span class="material-icons-outlined">admin_panel_settings</span>
          <span :class="{ 'lg:hidden': !sidebarVisible }">Role & Permission</span>
        </Link>

        <Link href="/activity" class="sidebar-link">
          <span class="material-icons-outlined">history</span>
          <span :class="{ 'lg:hidden': !sidebarVisible }">Activity Logs</span>
        </Link>

        <Link href="/profile" class="sidebar-link">
          <span class="material-icons-outlined">person</span>
          <span :class="{ 'lg:hidden': !sidebarVisible }">Profile Management</span>
        </Link>

        <Link href="/notifications" class="sidebar-link">
          <span class="material-icons-outlined">notifications</span>
          <span :class="{ 'lg:hidden': !sidebarVisible }">Notifications</span>
        </Link>

        <Link href="/settings" class="sidebar-link">
          <span class="material-icons-outlined">settings</span>
          <span :class="{ 'lg:hidden': !sidebarVisible }">Settings</span>
        </Link>
      </nav>
    </aside>

    <!-- Main Content -->
    <div :class="[
      'flex-1 transition-all duration-300 ease-in-out',
      sidebarVisible ? 'lg:ml-64' : 'lg:ml-20'
    ]">
      <!-- Header -->
      <header class="h-16 bg-bg-white border-b border-border-light sticky top-0 z-20">
        <div class="h-full px-4 flex items-center justify-between">
          <div class="flex items-center gap-4">
            <button @click="toggleSidebar" class="p-2 rounded-lg hover:bg-bg-lighter lg:hidden">
              <span class="material-icons-outlined">menu</span>
            </button>
            <div class="relative">
              <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-muted">search</span>
              <input type="text" placeholder="Search..." class="search-input pl-10" />
            </div>
          </div>

          <div class="flex items-center gap-4">
            <!-- Notifications -->
            <button class="p-2 rounded-lg hover:bg-bg-lighter relative">
              <span class="material-icons-outlined">notifications</span>
              <span class="absolute top-1 right-1 w-2 h-2 bg-danger rounded-full"></span>
            </button>

            <!-- Profile Dropdown -->
            <div class="relative">
              <button @click="toggleProfileDropdown" class="flex items-center gap-2 p-2 rounded-lg hover:bg-bg-lighter">
                <img src="/images/avatar.jpg" alt="Profile" class="w-8 h-8 rounded-full object-cover" />
                <span class="hidden sm:block font-medium">John Doe</span>
                <span class="material-icons-outlined">expand_more</span>
              </button>

              <div v-show="profileDropdownOpen" class="absolute right-0 mt-2 w-48 bg-bg-white rounded-lg shadow-lg border border-border-light">
                <div class="py-2">
                  <Link href="/profile" class="block px-4 py-2 text-sm hover:bg-bg-lighter">Profile</Link>
                  <Link href="/settings" class="block px-4 py-2 text-sm hover:bg-bg-lighter">Settings</Link>
                  <hr class="my-1 border-border-light" />
                  <Link href="/logout" method="post" as="button" class="block w-full text-left px-4 py-2 text-sm text-danger hover:bg-danger-light">
                    Logout
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="p-6">
        <slot />
      </main>
    </div>
  </div>
</template>