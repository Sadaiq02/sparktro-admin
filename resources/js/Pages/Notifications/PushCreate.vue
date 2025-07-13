<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const loading = ref(false);
const error = ref(null);
const title = ref('');
const image = ref(null);
const message = ref('');
const audience = ref(['Accelerator User Only']);
const schedule = ref(true);
const date = ref('2025-05-20');
const time = ref('10:00');

function handleImageUpload(e) {
  image.value = e.target.files[0];
}
</script>

<template>
  <Head title="Create Push Notification" />
  <AuthenticatedLayout>
    <div class="w-full min-h-[calc(100vh-80px)] bg-[#F8FAFC] flex items-start">
      <main class="flex-1 flex flex-col items-center">
        <div class="w-full max-w-6xl bg-white rounded-2xl shadow border border-gray-200 mt-10 mb-8 p-0">
          <div class="flex flex-col md:flex-row gap-8 px-8 pt-8 pb-8">
            <!-- Left: Form -->
            <div class="flex-1">
              <h2 class="text-2xl font-bold text-gray-900 mb-6">Create Push Notification</h2>
              <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-700 mb-1">Notification Image</label>
                <div class="flex items-center gap-2">
                  <input type="file" accept="image/*" @change="handleImageUpload" class="block w-full text-xs border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:bg-[#E6F7FA] file:text-[#0A97B0]" />
                  <span v-if="image" class="text-xs text-gray-500">{{ image.name }}</span>
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-700 mb-1">Notification Title</label>
                <input v-model="title" type="text" placeholder="Notification Title Here" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-xs sm:text-sm focus:ring-blue-500 focus:border-blue-500" />
              </div>
              <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-700 mb-1">Your answers</label>
                <!-- Mock rich text editor -->
                <div class="border border-gray-200 rounded-lg bg-gray-50 p-2">
                  <div class="flex items-center gap-2 mb-2">
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg"><b>B</b></button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg"><i>I</i></button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg">U</button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg">T</button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg">•</button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg">1.</button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg">☺</button>
                    <button class="text-gray-500 hover:text-[#0A97B0] text-lg">+</button>
                  </div>
                  <textarea v-model="message" rows="4" class="w-full border-0 bg-gray-50 text-xs sm:text-sm focus:ring-0 focus:outline-none resize-none" placeholder="Type your message here..."></textarea>
                </div>
              </div>
              <div class="flex flex-col sm:flex-row gap-2 mt-6">
                <button class="bg-[#0A97B0] hover:bg-[#09879b] text-white font-semibold rounded-lg px-6 py-2 text-xs sm:text-sm">Send Now</button>
                <button class="border border-[#0A97B0] text-[#0A97B0] font-semibold rounded-lg px-6 py-2 text-xs sm:text-sm bg-white">Save as Draft</button>
                <button class="border border-[#0A97B0] text-[#0A97B0] font-semibold rounded-lg px-6 py-2 text-xs sm:text-sm bg-white">Schedule</button>
              </div>
            </div>
            <!-- Right: Audience & Schedule -->
            <div class="w-full md:w-72 flex-shrink-0">
              <div class="mb-6">
                <div class="text-xs font-semibold text-gray-700 mb-2">Select Audience</div>
                <div class="flex flex-col gap-2">
                  <label class="flex items-center gap-2 text-xs font-medium text-gray-700">
                    <input type="checkbox" value="Accelerator User Only" v-model="audience" class="form-checkbox rounded text-[#0A97B0]" /> Accelerator User Only
                  </label>
                  <label class="flex items-center gap-2 text-xs font-medium text-gray-700">
                    <input type="checkbox" value="Subscribers Only" v-model="audience" class="form-checkbox rounded text-[#0A97B0]" /> Subscribers Only
                  </label>
                  <label class="flex items-center gap-2 text-xs font-medium text-gray-700">
                    <input type="checkbox" value="All Users Across Platforms" v-model="audience" class="form-checkbox rounded text-[#0A97B0]" /> All Users Across Platforms
                  </label>
                  <label class="flex items-center gap-2 text-xs font-medium text-gray-700">
                    <input type="checkbox" value="Custom Selection" v-model="audience" class="form-checkbox rounded text-[#0A97B0]" /> Custom Selection
                  </label>
                </div>
              </div>
              <div class="mb-6">
                <div class="text-xs font-semibold text-gray-700 mb-2">Delivery Options</div>
                <label class="flex items-center gap-2 text-xs font-medium text-gray-700 mb-2">
                  <input type="checkbox" v-model="schedule" class="form-checkbox rounded text-[#0A97B0]" /> Schedule For Later
                </label>
                <div class="flex gap-2">
                  <div>
                    <div class="text-xs text-gray-500 mb-1">Select Date</div>
                    <input type="date" v-model="date" class="border border-gray-300 rounded-lg px-2 py-2 text-xs focus:ring-blue-500 focus:border-blue-500 w-full" />
                  </div>
                  <div>
                    <div class="text-xs text-gray-500 mb-1">Select Time</div>
                    <input type="time" v-model="time" class="border border-gray-300 rounded-lg px-2 py-2 text-xs focus:ring-blue-500 focus:border-blue-500 w-full" />
                  </div>
                </div>
              </div>
              <button class="w-full text-xs text-gray-500 py-2 mt-2 hover:underline">Cancel</button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </AuthenticatedLayout>
</template> 