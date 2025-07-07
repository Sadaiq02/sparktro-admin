<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import LineChart from '@/Components/line-chart.vue';

const stats = [
  { label: 'Total Employees', value: 18, change: '+6.09%', icon: 'users', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Total Seller', value: 4, change: '-0.01%', icon: 'user-group', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: false },
  { label: 'Total Expenses', value: '$365.54', change: '-0.06%', icon: 'banknotes', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: false },
  { label: 'Total Deposits', value: '$0.00', change: '+0.00%', icon: 'banknotes', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Total Product', value: 9587, change: '-0.06%', icon: 'cube', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: false },
  { label: 'Total Tasks', value: 12, change: '+0.06%', icon: 'clipboard-document-list', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Total Order', value: 64, change: '+0.16%', icon: 'shopping-cart', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Total Sale', value: '$654.57', change: '+0.16%', icon: 'currency-dollar', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Total Refunded', value: '$9124.25', change: '+0.16%', icon: 'arrow-uturn-left', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Total Revenue', value: '$265.35', change: '+0.16%', icon: 'chart-bar', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'New Customer', value: 842, change: '+0.16%', icon: 'user-plus', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: true },
  { label: 'Pending Order', value: 64, change: '-0.09%', icon: 'clock', color: 'text-[#0A97B0]', bg: 'bg-[#E6F7FA]', up: false },
];

const icons = {
  users: `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m9-4a4 4 0 1 0-8 0 4 4 0 0 0 8 0z'/></svg>`,
  'user-group': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m9-4a4 4 0 1 0-8 0 4 4 0 0 0 8 0z'/></svg>`,
  banknotes: `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 8c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z'/></svg>`,
  cube: `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M20 7l-8-4-8 4m16 0v6a8 8 0 01-16 0V7m16 0L12 13 4 7'/></svg>`,
  'clipboard-document-list': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2V7a2 2 0 00-2-2h-1.5a1.5 1.5 0 01-3 0H8a2 2 0 00-2 2v12a2 2 0 002 2z'/></svg>`,
  'shopping-cart': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10a1 1 0 00.95-.68l3.24-7.24A1 1 0 0020 7H7.4M7 13V6a1 1 0 011-1h5a1 1 0 011 1v7'/></svg>`,
  'currency-dollar': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 8c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z'/></svg>`,
  'arrow-uturn-left': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 14l-4-4m0 0l4-4m-4 4h12a4 4 0 110 8h-1'/></svg>`,
  'chart-bar': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 3v18h18'/></svg>`,
  'user-plus': `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M16 11V7a4 4 0 10-8 0v4M12 19v2m-6-2a6 6 0 0112 0v2'/></svg>`,
  clock: `<svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'/></svg>`,
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="flex flex-col gap-6 px-4 md:px-8 py-8 bg-[#F8FAFC] min-h-screen">
            <!-- Stats Cards -->
            <section class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div v-for="(stat, i) in stats" :key="i" class="bg-white rounded-xl shadow p-4 flex flex-col items-start border border-gray-100 min-w-[140px]">
                    <div class="flex items-center gap-2 mb-2">
                        <span :class="`inline-flex items-center justify-center w-7 h-7 rounded-full ${stat.bg} ${stat.color}`" v-html="icons[stat.icon]"></span>
                        <span class="text-xs text-gray-500 font-medium">{{ stat.label }}</span>
                    </div>
                    <div class="flex items-end gap-2">
                        <span class="text-xl font-bold text-gray-900">{{ stat.value }}</span>
                        <span class="text-xs flex items-center" :class="stat.up ? 'text-green-600' : 'text-red-600'">
                            <svg v-if="stat.up" class="h-3 w-3 mr-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                            <svg v-else class="h-3 w-3 mr-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7-7-7"/></svg>
                            {{ stat.change }}
                        </span>
                    </div>
                </div>
            </section>

            <!-- Main Grid: Figma-accurate, responsive -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Row 1: Revenue (1/2) + Sales (1/2) -->
                <div class="flex flex-col gap-6">
                    <div class="bg-white rounded-xl shadow p-6 min-h-[300px] flex flex-col h-full">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">Revenue</h2>
                            <span class="text-xs text-gray-400">May 2025</span>
                        </div>
                        <LineChart :chartData="revenueChartData" :chartOptions="revenueChartOptions" :loading="loading" />
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="bg-white rounded-xl shadow p-6 min-h-[300px] flex flex-col h-full">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">Sales</h2>
                            <span class="text-xs text-gray-400">May 2025</span>
                        </div>
                        <div class="flex-1 flex items-center justify-center text-gray-400">[Bar Chart]</div>
                    </div>
                </div>
                <!-- Row 2: Calendar + Browse Status + Task Status -->
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow p-6 min-h-[220px] flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">Calendar Schedule</h2>
                            <span class="text-xs text-gray-400">May 2025</span>
                        </div>
                        <div class="flex-1 flex items-center justify-center text-gray-400">[Calendar Widget]</div>
                    </div>
                    <div class="bg-white rounded-xl shadow p-6 min-h-[220px] flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">Browse Status</h2>
                        </div>
                        <div class="flex-1 flex items-center justify-center text-gray-400">[Pie Chart]</div>
                    </div>
                    <div class="bg-white rounded-xl shadow p-6 min-h-[220px] flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">Task Status</h2>
                        </div>
                        <div class="flex-1 flex items-center justify-center text-gray-400">[Task Status Chart]</div>
                        <div class="flex justify-between mt-4">
                            <div class="flex flex-col items-center">
                                <span class="text-lg font-bold text-[#0A97B0]">982</span>
                                <span class="text-xs text-gray-400">Complete Task</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-lg font-bold text-yellow-500">126</span>
                                <span class="text-xs text-gray-400">Pending Task</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-lg font-bold text-red-500">65</span>
                                <span class="text-xs text-gray-400">Due Task</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 3: Recent Order (1/2) + New Customer (1/2) -->
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow p-6 min-h-[220px] flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">Recent Order</h2>
                        </div>
                        <div class="flex-1 flex items-center justify-center text-gray-400">[Recent Order Table]</div>
                    </div>
                    <div class="bg-white rounded-xl shadow p-6 min-h-[220px] flex flex-col">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-semibold text-gray-800">New Customer</h2>
                        </div>
                        <div class="flex-1 flex items-center justify-center text-gray-400">[New Customer Table]</div>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
