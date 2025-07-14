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
      data: [30, 40, 45, 50, 49, 60, 70, 91, 125, 150, 200, 100],
      borderColor: '#0A97B0',
      backgroundColor: 'rgba(10, 151, 176, 0.1)',
      fill: true,
      tension: 0.4,
      pointRadius: 0,
      pointHitRadius: 10,
      borderWidth: 2
    },
    {
      label: 'Expenses',
      data: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70],
      borderColor: '#A0AEC0',
      backgroundColor: 'rgba(160, 174, 192, 0.1)',
      fill: true,
      tension: 0.4,
      pointRadius: 0,
      pointHitRadius: 10,
      borderWidth: 2
    }
  ]
};

const salesChartData = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  datasets: [
    {
      label: 'Sales',
      data: [65, 75, 85, 95, 105, 115, 125, 135, 145, 155, 165, 175],
      backgroundColor: '#0A97B0',
      borderRadius: 4,
      barThickness: 12,
      maxBarThickness: 12
    },
    {
      label: 'Orders',
      data: [45, 55, 65, 75, 85, 95, 105, 115, 125, 135, 145, 155],
      backgroundColor: '#A0AEC0',
      borderRadius: 4,
      barThickness: 12,
      maxBarThickness: 12
    }
  ]
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
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
                <div class="flex items-center gap-4">
                    <button class="btn-secondary">
                        <span class="material-icons-outlined text-lg mr-2">file_download</span>
                        Export
                    </button>
                    <button class="btn-primary">
                        <span class="material-icons-outlined text-lg mr-2">add</span>
                        Add New
                    </button>
                </div>
            </div>
        </template>

        <div class="flex flex-col gap-6 p-6 bg-[#F8FAFC] min-h-screen">
            <!-- Stats Cards -->
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                <div v-for="(stat, i) in stats" :key="i" 
                    class="bg-white rounded-xl shadow-sm p-4 flex flex-col items-start border border-[#D6E2EF] hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-3 mb-3 w-full">
                        <span :class="`inline-flex items-center justify-center w-10 h-10 rounded-full ${stat.bg} ${stat.color}`" 
                            v-html="icons[stat.icon]"></span>
                        <span class="text-sm text-gray-500 font-medium truncate">{{ stat.label }}</span>
                    </div>
                    <div class="flex items-end gap-2 w-full">
                        <span class="text-xl font-bold text-gray-900 truncate">{{ stat.value }}</span>
                        <span class="text-xs flex items-center gap-1" :class="stat.up ? 'text-success' : 'text-danger'">
                            <span class="material-icons-outlined text-sm">
                                {{ stat.up ? 'trending_up' : 'trending_down' }}
                            </span>
                            {{ stat.change }}
                        </span>
                    </div>
                </div>
            </section>

            <!-- Charts Grid -->
            <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                <!-- Revenue Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 min-h-[400px]">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Revenue</h2>
                            <p class="text-sm text-gray-500 mt-1">Monthly revenue statistics</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <button class="text-sm text-gray-500 hover:text-primary">This Year</button>
                            <button class="text-sm text-gray-500 hover:text-primary">This Month</button>
                            <button class="text-sm text-gray-500 hover:text-primary">This Week</button>
                        </div>
                    </div>
                    <LineChart :chartData="revenueChartData" class="h-[300px]" />
                </div>

                <!-- Sales Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 min-h-[400px]">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">Sales Statistics</h2>
                            <p class="text-sm text-gray-500 mt-1">Monthly sales overview</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <button class="text-sm text-gray-500 hover:text-primary">This Year</button>
                            <button class="text-sm text-gray-500 hover:text-primary">This Month</button>
                            <button class="text-sm text-gray-500 hover:text-primary">This Week</button>
                        </div>
                    </div>
                    <BarChart :chartData="salesChartData" class="h-[300px]" />
                </div>
            </section>

            <!-- Calendar, Browser Status, Task Status Grid -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Calendar Schedule</h2>
                        <button class="text-sm text-primary hover:text-primary-dark">View All</button>
                    </div>
                    <CalendarWidget v-model:selectedDate="selectedDate" class="h-[250px]" />
                </div>

                <!-- Browser Status -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Browser Status</h2>
                        <button class="text-sm text-primary hover:text-primary-dark">View Details</button>
                    </div>
                    <PieChart :data="browseStatusData" class="h-[250px]" />
                </div>

                <!-- Task Status -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Task Status</h2>
                        <button class="text-sm text-primary hover:text-primary-dark">View All Tasks</button>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary">{{ taskStatus.complete }}</div>
                            <div class="text-sm text-gray-500 mt-1">Complete</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-warning">{{ taskStatus.pending }}</div>
                            <div class="text-sm text-gray-500 mt-1">Pending</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-danger">{{ taskStatus.due }}</div>
                            <div class="text-sm text-gray-500 mt-1">Due</div>
                        </div>
                    </div>
                    <LineChart 
                        :chartData="{ 
                            labels: Array(taskStatus.chart.length).fill(''), 
                            datasets: [{ 
                                label: 'Tasks', 
                                data: taskStatus.chart,
                                borderColor: '#0A97B0',
                                backgroundColor: 'rgba(10,151,176,0.1)',
                                fill: true,
                                tension: 0.4,
                                pointRadius: 0
                            }] 
                        }" 
                        class="h-[100px]"
                    />
                </div>
            </section>

            <!-- Tables Grid -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">Recent Orders</h2>
                        <button class="text-sm text-primary hover:text-primary-dark">View All Orders</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">IMAGE</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">CUSTOMER NAME</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">QTY</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">DATE</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">PRICE</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">STATUS</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order, i) in recentOrders" :key="i" class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <img :src="`/images/${order.image}`" :alt="order.customer" class="w-10 h-10 rounded object-cover" />
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ order.customer }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ order.qty }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ order.date }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ order.price }}</td>
                                    <td class="px-4 py-3">
                                        <span :class="`px-2 py-1 rounded-full text-xs font-medium ${
                                            order.status === 'Paid' ? 'bg-success-light text-success' : 'bg-danger-light text-danger'
                                        }`">
                                            {{ order.status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-gray-400 hover:text-primary">
                                            <span class="material-icons-outlined">more_vert</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- New Customers -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-semibold text-gray-800">New Customers</h2>
                        <button class="text-sm text-primary hover:text-primary-dark">View All Customers</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">IMAGE</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">CUSTOMER NAME</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">COUNTRY</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">DATE</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">STATUS</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customer, i) in newCustomers" :key="i" class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <img :src="`/images/${customer.image}`" :alt="customer.name" class="w-10 h-10 rounded-full object-cover" />
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ customer.name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ customer.country }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ customer.date }}</td>
                                    <td class="px-4 py-3">
                                        <span :class="`px-2 py-1 rounded-full text-xs font-medium ${
                                            customer.status === 'Active' ? 'bg-success-light text-success' : 'bg-danger-light text-danger'
                                        }`">
                                            {{ customer.status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-gray-400 hover:text-primary">
                                            <span class="material-icons-outlined">more_vert</span>
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
