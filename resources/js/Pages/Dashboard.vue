<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import LineChart from '@/Components/line-chart.vue';
import BarChart from '@/Components/bar-chart.vue';
import PieChart from '@/Components/pie-chart.vue';
import CalendarWidget from '@/Components/calendar-widget.vue';
import { ref } from 'vue';

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

// Example Revenue Chart Data (Line)
const revenueChartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label: 'Revenue',
      data: [0.2, 0.3, 0.4, 0.5, 0.7, 0.9, 1.0, 0.95, 0.85, 0.8, 0.7, 0.6],
      borderColor: '#0A97B0',
      backgroundColor: 'rgba(10,151,176,0.1)',
      fill: true,
      tension: 0.4,
    },
    {
      label: 'Expenses',
      data: [0.1, 0.15, 0.2, 0.25, 0.4, 0.5, 0.6, 0.55, 0.5, 0.45, 0.4, 0.35],
      borderColor: '#A0AEC0',
      backgroundColor: 'rgba(160,174,192,0.1)',
      fill: true,
      tension: 0.4,
    },
  ],
};

// Sales Chart Data (Bar)
const salesChartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label: 'Sales',
      data: [0.3, 0.4, 0.8, 0.6, 0.7, 0.9, 0.8, 0.5, 0.6, 0.7, 0.8, 0.9],
      backgroundColor: '#0A97B0',
    },
    {
      label: 'Order',
      data: [0.2, 0.3, 0.5, 0.4, 0.5, 0.7, 0.6, 0.4, 0.5, 0.6, 0.7, 0.8],
      backgroundColor: '#A0AEC0',
    },
  ],
};

// Browse Status Pie Data
const browseStatusData = [
  { label: 'Firefox', value: 354612365 },
  { label: 'Google Chrome', value: 254612365 },
  { label: 'Microsoft Edge', value: 154612365 },
  { label: 'Opera', value: 54612365 },
];

// Task Status Data
const taskStatus = {
  complete: 982,
  pending: 126,
  due: 65,
  chart: [
    800, 820, 830, 850, 870, 900, 920, 950, 970, 982, 980, 990, 1000, 1010, 1020, 1030, 1040, 1050, 1060, 1070, 1080, 1090, 1100, 1110, 1120, 1130, 1140, 1150, 1160, 1170
  ],
};

// Recent Order Table Data
const recentOrders = [
  { image: 'iphone-13-pro-max.png', customer: 'iPhone 13 pro max', qty: 1, date: '11 May 2025', price: '$360.05', status: 'Paid' },
  { image: 'iphone-13-pro-max.png', customer: 'iPhone 13 pro max', qty: 1, date: '11 May 2025', price: '$360.05', status: 'Paid' },
  { image: 'iphone-13-pro-max.png', customer: 'iPhone 13 pro max', qty: 1, date: '11 May 2025', price: '$360.05', status: 'Paid' },
  { image: 'iphone-13-pro-max.png', customer: 'iPhone 13 pro max', qty: 1, date: '11 May 2025', price: '$360.05', status: 'Unpaid' },
  { image: 'iphone-13-pro-max.png', customer: 'iPhone 13 pro max', qty: 1, date: '11 May 2025', price: '$360.05', status: 'Paid' },
];

// New Customer Table Data
const newCustomers = [
  { image: 'avatar1.png', name: 'Jacob Jones', country: 'United State', date: '11 May 2025', status: 'Active' },
  { image: 'avatar2.png', name: 'Savannah Nguyen', country: 'United State', date: '11 May 2025', status: 'Inactive' },
  { image: 'avatar3.png', name: 'Marvin McKinney', country: 'United State', date: '11 May 2025', status: 'Active' },
  { image: 'avatar4.png', name: 'Brooklyn Simmons', country: 'United State', date: '11 May 2025', status: 'Inactive' },
  { image: 'avatar5.png', name: 'Wade Warren', country: 'United State', date: '11 May 2025', status: 'Active' },
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

const selectedDate = ref(new Date());
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

        <div class="flex flex-col gap-4 sm:gap-6 px-2 sm:px-8 md:px-8 bg-[#F8FAFC] min-h-screen">
            <!-- Stats Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-3 sm:gap-4">
                <div v-for="(stat, i) in stats" :key="i" class="bg-white rounded-xl shadow p-3 sm:p-4 flex flex-col items-start border border-gray-100 min-w-0">
                    <div class="flex items-center gap-2 mb-2 w-full">
                        <span :class="`inline-flex items-center justify-center w-6 h-6 sm:w-7 sm:h-7 rounded-full ${stat.bg} ${stat.color} flex-shrink-0`" v-html="icons[stat.icon]"></span>
                        <span class="text-xs text-gray-500 font-medium truncate">{{ stat.label }}</span>
                    </div>
                    <div class="flex items-end gap-2 w-full">
                        <span class="text-lg sm:text-xl font-bold text-gray-900 truncate">{{ stat.value }}</span>
                        <span class="text-xs flex items-center flex-shrink-0" :class="stat.up ? 'text-green-600' : 'text-red-600'">
                            <svg v-if="stat.up" class="h-3 w-3 mr-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                            <svg v-else class="h-3 w-3 mr-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7-7-7"/></svg>
                            {{ stat.change }}
                        </span>
                    </div>
                </div>
            </section>

            <!-- Main Grid: Enhanced responsive layout -->
            <section class="grid grid-cols-1 xl:grid-cols-2 gap-4 sm:gap-6">
                <!-- Row 1: Revenue (1/2) + Sales (1/2) -->
                <div class="flex flex-col gap-6">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[300px] flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-semibold text-gray-800 text-lg">Revenue</h2>
                            <span class="text-xs text-gray-400">May 2025</span>
                        </div>
                        <div class="flex-1 min-h-[250px]">
                        <LineChart :chartData="revenueChartData" :chartOptions="revenueChartOptions" :loading="loading" />
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[300px] flex flex-col h-full">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-semibold text-gray-800 text-lg">Sales</h2>
                            <span class="text-xs text-gray-400">May 2025</span>
                        </div>
                        <div v-if="!salesChartData" class="flex-1 flex items-center justify-center text-gray-400">Loading...</div>
                        <div v-else class="flex-1 min-h-[250px]">
                          <BarChart :chartData="salesChartData" />
                        </div>
                    </div>
                </div>
            </section>

                <!-- Row 2: Calendar + Browse Status + Task Status -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[220px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-gray-800 text-lg">Calendar Schedule</h2>
                            <span class="text-xs text-gray-400">May 2025</span>
                        </div>
                    <div class="flex-1 flex items-center justify-center">
                          <CalendarWidget v-model:selectedDate="selectedDate" />
                        </div>
                    </div>
                <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[220px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-gray-800 text-lg">Browse Status</h2>
                        </div>
                        <div v-if="!browseStatusData" class="flex-1 flex items-center justify-center text-gray-400">Loading...</div>
                        <div v-else class="flex-1 flex items-center justify-center">
                          <PieChart :data="browseStatusData" />
                        </div>
                    </div>
                <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[220px] flex flex-col md:col-span-2 lg:col-span-1">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-gray-800 text-lg">Task Status</h2>
                        </div>
                        <div v-if="!taskStatus.chart" class="flex-1 flex items-center justify-center text-gray-400">Loading...</div>
                        <div v-else class="flex-1 flex items-center justify-center">
                          <LineChart :chartData="{ labels: Array(taskStatus.chart.length).fill(''), datasets: [{ label: 'Tasks', data: taskStatus.chart, borderColor: '#0A97B0', backgroundColor: 'rgba(10,151,176,0.1)', fill: true, tension: 0.4 }] }" />
                        </div>
                    <div class="flex justify-between mt-4 gap-2">
                        <div class="flex flex-col items-center flex-1">
                                <span class="text-lg font-bold text-[#0A97B0]">{{ taskStatus.complete }}</span>
                            <span class="text-xs text-gray-400 text-center">Complete Task</span>
                            </div>
                        <div class="flex flex-col items-center flex-1">
                                <span class="text-lg font-bold text-yellow-500">{{ taskStatus.pending }}</span>
                            <span class="text-xs text-gray-400 text-center">Pending Task</span>
                            </div>
                        <div class="flex flex-col items-center flex-1">
                                <span class="text-lg font-bold text-red-500">{{ taskStatus.due }}</span>
                            <span class="text-xs text-gray-400 text-center">Due Task</span>
                        </div>
                    </div>
                </div>
            </section>

                <!-- Row 3: Recent Order (1/2) + New Customer (1/2) -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[220px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-gray-800 text-lg">Recent Order</h2>
                        </div>
                    <div class="overflow-x-auto flex-1">
                          <table class="min-w-full text-xs">
                            <thead>
                          <tr class="border-b border-gray-200">
                            <th class="px-2 py-2 text-left font-medium text-gray-600">IMAGE</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">CUSTOMER NAME</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">QTY</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600 hidden sm:table-cell">DATE</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600 hidden md:table-cell">PRICE</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">STATUS</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                          <tr v-for="(order, i) in recentOrders" :key="i" class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-2 py-2"><img :src="`/images/${order.image}`" alt="" class="w-6 h-6 sm:w-8 sm:h-8 rounded object-cover" /></td>
                            <td class="px-2 py-2 font-medium text-gray-900 truncate max-w-[100px] sm:max-w-[150px]">{{ order.customer }}</td>
                            <td class="px-2 py-2">{{ order.qty }}</td>
                            <td class="px-2 py-2 hidden sm:table-cell text-gray-600">{{ order.date }}</td>
                            <td class="px-2 py-2 hidden md:table-cell font-medium">{{ order.price }}</td>
                            <td class="px-2 py-2">
                              <span :class="order.status === 'Paid' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'" class="px-2 py-1 rounded text-xs">
                                    {{ order.status }}
                                  </span>
                                </td>
                            <td class="px-2 py-2">
                              <button class="text-gray-400 hover:text-[#0A97B0] p-1">
                                <i class="material-icons-outlined text-sm">more_vert</i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                <div class="bg-white rounded-xl shadow p-4 sm:p-6 min-h-[220px] flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-semibold text-gray-800 text-lg">New Customer</h2>
                        </div>
                    <div class="overflow-x-auto flex-1">
                          <table class="min-w-full text-xs">
                            <thead>
                          <tr class="border-b border-gray-200">
                            <th class="px-2 py-2 text-left font-medium text-gray-600">IMAGE</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">CUSTOMER NAME</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600 hidden sm:table-cell">COUNTRY</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600 hidden md:table-cell">DATE</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">STATUS</th>
                            <th class="px-2 py-2 text-left font-medium text-gray-600">ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                          <tr v-for="(customer, i) in newCustomers" :key="i" class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="px-2 py-2"><img :src="`/images/${customer.image}`" alt="" class="w-6 h-6 sm:w-8 sm:h-8 rounded-full object-cover" /></td>
                            <td class="px-2 py-2 font-medium text-gray-900 truncate max-w-[100px] sm:max-w-[150px]">{{ customer.name }}</td>
                            <td class="px-2 py-2 hidden sm:table-cell text-gray-600">{{ customer.country }}</td>
                            <td class="px-2 py-2 hidden md:table-cell text-gray-600">{{ customer.date }}</td>
                            <td class="px-2 py-2">
                              <span :class="customer.status === 'Active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'" class="px-2 py-1 rounded text-xs">
                                    {{ customer.status }}
                                  </span>
                                </td>
                            <td class="px-2 py-2">
                              <button class="text-gray-400 hover:text-[#0A97B0] p-1">
                                <i class="material-icons-outlined text-sm">more_vert</i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
