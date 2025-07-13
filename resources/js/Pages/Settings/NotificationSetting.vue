<template>
  <div class="notification-setting">
    <h3 class="section-title">Notification</h3>
    <p class="section-desc">Get notification what's happening right now, you can turn off at any time.</p>
    <div class="notification-grid">
      <!-- Email Notification Card -->
      <div class="notify-card">
        <div class="notify-card-header">
          <div>
            <div class="notify-card-title">Email Notification</div>
            <div class="notify-card-desc">Substance can send you email notifications for any new direct messages.</div>
          </div>
          <label class="switch">
            <input type="checkbox" v-model="emailToggle" />
            <span class="slider"></span>
          </label>
        </div>
        <div class="notify-options">
          <label v-for="option in emailOptions" :key="option.key" class="option-row">
            <input type="checkbox" v-model="option.checked" />
            <span class="custom-checkbox" :class="{ checked: option.checked }"></span>
            <span class="option-title">{{ option.label }}</span>
            <span class="option-desc">{{ option.desc }}</span>
          </label>
        </div>
      </div>
      <!-- More Activity Card -->
      <div class="notify-card">
        <div class="notify-card-header">
          <div>
            <div class="notify-card-title">More Activity</div>
            <div class="notify-card-desc">Substance can send you email notifications for any new direct messages.</div>
          </div>
          <label class="switch">
            <input type="checkbox" v-model="activityToggle" />
            <span class="slider"></span>
          </label>
        </div>
        <div class="notify-options">
          <label v-for="option in activityOptions" :key="option.key" class="option-row">
            <input type="checkbox" v-model="option.checked" />
            <span class="custom-checkbox" :class="{ checked: option.checked }"></span>
            <span class="option-title">{{ option.label }}</span>
            <span class="option-desc">{{ option.desc }}</span>
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
const emailToggle = ref(true);
const activityToggle = ref(true);
const emailOptions = reactive([
  { key: 'news', label: 'News & Update Settings', desc: 'The latest news about the latest features and software update settings.', checked: true },
  { key: 'tips', label: 'Tips and Tutorials', desc: 'The latest news about the latest features and software update settings.', checked: false },
  { key: 'offers', label: 'Offer and Promotions', desc: 'The latest news about the latest features and software update settings.', checked: false },
]);
const activityOptions = reactive([
  { key: 'all', label: 'All Reminders & Activity', desc: 'The latest news about the latest features and software update settings.', checked: true },
  { key: 'activity', label: 'Activity Only', desc: 'The latest news about the latest features and software update settings.', checked: true },
  { key: 'important', label: 'Important Reminder Only', desc: 'The latest news about the latest features and software update settings.', checked: false },
]);
</script>

<style scoped>
.notification-setting {
  padding: 0 8px;
}
.section-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 4px;
  color: #23293a;
}
.section-desc {
  color: #6b7280;
  font-size: 1.01rem;
  margin-bottom: 18px;
}
.notification-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}
.notify-card {
  background: #fff;
  border: 1.5px solid #e5e7eb;
  border-radius: 12px;
  padding: 24px 24px 18px 24px;
  box-shadow: 0 2px 8px 0 rgba(10,151,176,0.06);
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.notify-card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 8px;
}
.notify-card-title {
  font-size: 1.08rem;
  font-weight: 600;
  color: #23293a;
}
.notify-card-desc {
  color: #6b7280;
  font-size: 0.98rem;
  margin-top: 2px;
}
.notify-options {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.option-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 6px 0;
  cursor: pointer;
  position: relative;
}
.option-row input[type="checkbox"] {
  display: none;
}
.custom-checkbox {
  width: 22px;
  height: 22px;
  border-radius: 6px;
  border: 2px solid #e5e7eb;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 2px;
  transition: border 0.2s, background 0.2s;
}
.custom-checkbox.checked {
  background: #0a97b0;
  border-color: #0a97b0;
}
.custom-checkbox.checked::after {
  content: '';
  display: block;
  width: 10px;
  height: 10px;
  border-radius: 3px;
  background: #fff;
}
.option-title {
  font-weight: 600;
  color: #23293a;
  font-size: 1rem;
  margin-right: 6px;
}
.option-desc {
  color: #6b7280;
  font-size: 0.97rem;
  margin-top: 1px;
}
.switch {
  position: relative;
  display: inline-block;
  width: 44px;
  height: 24px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #e5e7eb;
  border-radius: 24px;
  transition: background 0.2s;
}
.switch input:checked + .slider {
  background-color: #0a97b0;
}
.slider:before {
  position: absolute;
  content: '';
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: #fff;
  border-radius: 50%;
  transition: transform 0.2s;
  box-shadow: 0 1px 2px rgba(44,62,80,0.10);
}
.switch input:checked + .slider:before {
  transform: translateX(20px);
}
@media (max-width: 900px) {
  .notification-grid {
    grid-template-columns: 1fr;
  }
}
</style> 