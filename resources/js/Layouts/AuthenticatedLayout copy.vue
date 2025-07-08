<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const userMenuOpen = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav
                class="border-b border-gray-100 bg-white"
            >
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <ul class="space-y-1">
                                    <li>
                                        <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                            Dashboard
                                        </NavLink>
                                    </li>
                                    <li>
                                        <div @click="userMenuOpen = !userMenuOpen"
                                            class="cursor-pointer py-2 px-3 text-sm font-bold flex justify-between items-center text-black-sparktro hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200">
                                            <span class="flex items-center mr-2">
                                                <i class="material-icons-outlined mr-2">group</i>
                                                User Management
                                            </span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300"
                                                :class="{ 'rotate-90': userMenuOpen }" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                        <transition enter-active-class="transition duration-300 ease-out"
                                            enter-from-class="opacity-0 max-h-0" enter-to-class="opacity-100 max-h-40"
                                            leave-active-class="transition duration-300 ease-in" leave-from-class="opacity-100 max-h-40"
                                            leave-to-class="opacity-0 max-h-0">
                                            <ul v-show="userMenuOpen" class="ml-8 mt-0 space-y-1 overflow-hidden">
                                                <li>
                                                    <a href="#" class="block text-sm font-medium text-black-sparktro/80 hover:text-primary-sparktro py-1 pl-2">List Users</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block text-sm font-medium text-black-sparktro/80 hover:text-primary-sparktro py-1 pl-2">Create New User</a>
                                                </li>
                                            </ul>
                                        </transition>
                                    </li>
                                    <li>
                                        <div class="py-2 px-3 flex items-center justify-between font-bold text-sm text-black-sparktro hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200 cursor-pointer">
                                            <span class="flex items-center">
                                                <i class="material-icons-outlined mr-2">history</i>
                                                Activity Logs
                                            </span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="py-2 px-3 flex items-center justify-between font-bold text-sm text-black-sparktro hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200 cursor-pointer">
                                            <span class="flex items-center">
                                                <i class="material-icons-outlined mr-2">person</i>
                                                Profile Management
                                            </span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="py-2 px-3 flex items-center justify-between font-bold text-sm text-black-sparktro hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200 cursor-pointer">
                                            <span class="flex items-center">
                                                <i class="material-icons-outlined mr-2">notifications</i>
                                                Notifications
                                            </span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="py-2 px-3 flex items-center justify-between font-bold text-sm text-black-sparktro hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200 cursor-pointer">
                                            <span class="flex items-center">
                                                <i class="material-icons-outlined mr-2">settings</i>
                                                Settings
                                            </span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="py-2 px-3 flex items-center justify-between font-bold text-sm text-black-sparktro hover:text-primary-sparktro hover:bg-primary-sparktro/10 rounded transition-colors duration-200 cursor-pointer">
                                            <span class="flex items-center">
                                                <i class="material-icons-outlined mr-2">logout</i>
                                                Logout
                                            </span>
                                            <svg class="w-4 h-4 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4"
                    >
                        <div class="px-4">
                            <div
                                class="text-base font-medium text-gray-800"
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-white shadow"
                v-if="$slots.header"
            >
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
