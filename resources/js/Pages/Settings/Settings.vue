<template>
  <div class="settings-container">
    <div class="settings-header">
      <h2 class="settings-title">Settings</h2>
      <div class="settings-tabs">
        <button
          v-for="tab in tabs"
          :key="tab.key"
          :class="['settings-tab', { active: currentTab === tab.key }]"
          @click="currentTab = tab.key"
        >
          <span v-if="tab.icon" :class="tab.icon" class="tab-icon"></span>
          {{ tab.label }}
        </button>
      </div>
    </div>
    <div class="settings-content">
      <component :is="currentTabComponent" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GeneralSetting from './GeneralSetting.vue';
import ThemeSetting from './ThemeSetting.vue';
import NotificationSetting from './NotificationSetting.vue';
import LanguageSetting from './LanguageSetting.vue';

const tabs = [
  { key: 'general', label: 'General Setting' },
  { key: 'theme', label: 'Theme Setting' },
  { key: 'notification', label: 'Notification' },
  { key: 'language', label: 'Language' },
];

const currentTab = ref('general');

const currentTabComponent = computed(() => {
  switch (currentTab.value) {
    case 'general':
      return GeneralSetting;
    case 'theme':
      return ThemeSetting;
    case 'notification':
      return NotificationSetting;
    case 'language':
      return LanguageSetting;
    default:
      return GeneralSetting;
  }
});

defineOptions({
  layout: AuthenticatedLayout
});
</script>

<style scoped>
.settings-container {
  background: #fff;
  border-radius: 12px;
  margin: 32px auto 0 auto;
  padding: 32px 32px 40px 32px;
  box-shadow: 0 4px 24px 0 rgba(0,0,0,0.06);
  max-width: 1000px;
  width: 100%;
  border: 1.5px solid #e5e7eb;
}
.settings-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 32px;
  flex-wrap: wrap;
  gap: 16px;
}
.settings-title {
  font-size: 1.7rem;
  font-weight: 700;
  margin: 0;
  color: #23293a;
}
.settings-tabs {
  display: flex;
  gap: 16px;
  flex-wrap: wrap;
}
.settings-tab {
  background: #f8fafc;
  border: 1.5px solid #e5e7eb;
  border-radius: 8px;
  padding: 10px 28px;
  font-size: 1.08rem;
  font-weight: 500;
  color: #1e2533;
  cursor: pointer;
  transition: all 0.2s;
  min-width: 140px;
  text-align: center;
  outline: none;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}
.settings-tab.active {
  background: #e6f7fa;
  border-color: #0a97b0;
  color: #0a97b0;
}
.settings-content {
  margin-top: 24px;
}

/* Responsive styles */
@media (max-width: 900px) {
  .settings-container {
    max-width: 99vw;
    padding: 18px 6vw 24px 6vw;
  }
  .settings-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 18px;
  }
  .settings-tabs {
    width: 100%;
    justify-content: flex-start;
    gap: 8px;
  }
}
@media (max-width: 600px) {
  .settings-container {
    max-width: 100vw;
    padding: 0 0 12px 0;
    border-radius: 0;
    box-shadow: none;
    border: none;
  }
  .settings-header {
    flex-direction: column;
    align-items: stretch;
    gap: 8px;
    margin-bottom: 10px;
  }
  .settings-title {
    font-size: 1.1rem;
  }
  .settings-tabs {
    flex-direction: column;
    gap: 6px;
    width: 100%;
  }
  .settings-tab {
    width: 100%;
    min-width: unset;
    padding: 12px 0;
    font-size: 1rem;
  }
  .settings-content {
    margin-top: 8px;
  }
}
</style> 