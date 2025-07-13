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
          <span class="tab-label">{{ tab.label }}</span>
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
  { key: 'general', label: 'General Setting', icon: 'material-icons-outlined' },
  { key: 'theme', label: 'Theme Setting', icon: 'material-icons-outlined' },
  { key: 'notification', label: 'Notification', icon: 'material-icons-outlined' },
  { key: 'language', label: 'Language', icon: 'material-icons-outlined' },
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
  margin: 16px auto 0 auto;
  padding: 20px 16px 24px 16px;
  box-shadow: 0 4px 24px 0 rgba(0,0,0,0.06);
  max-width: 1000px;
  width: 100%;
  border: 1.5px solid #e5e7eb;
}

.settings-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 24px;
  flex-wrap: wrap;
  gap: 16px;
}

.settings-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin: 0;
  color: #23293a;
}

.settings-tabs {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.settings-tab {
  background: #f8fafc;
  border: 1.5px solid #e5e7eb;
  border-radius: 8px;
  padding: 8px 16px;
  font-size: 0.9rem;
  font-weight: 500;
  color: #1e2533;
  cursor: pointer;
  transition: all 0.2s;
  min-width: 120px;
  text-align: center;
  outline: none;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  white-space: nowrap;
}

.settings-tab:hover {
  background: #f1f5f9;
  border-color: #cbd5e1;
}

.settings-tab.active {
  background: #e6f7fa;
  border-color: #0a97b0;
  color: #0a97b0;
}

.tab-icon {
  font-size: 1.1rem;
}

.tab-label {
  font-size: 0.9rem;
}

.settings-content {
  margin-top: 20px;
}

/* Responsive styles */
@media (max-width: 768px) {
  .settings-container {
    margin: 8px 8px 0 8px;
    padding: 16px 12px 20px 12px;
    border-radius: 8px;
  }
  
  .settings-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
  }
  
  .settings-title {
    font-size: 1.3rem;
  }
  
  .settings-tabs {
    width: 100%;
    justify-content: flex-start;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 4px;
  }
  
  .settings-tab {
    min-width: 100px;
    padding: 6px 12px;
    font-size: 0.85rem;
    flex-shrink: 0;
  }
  
  .tab-label {
    font-size: 0.85rem;
  }
}

@media (max-width: 480px) {
  .settings-container {
    margin: 4px 4px 0 4px;
    padding: 12px 8px 16px 8px;
    border-radius: 6px;
  }
  
  .settings-header {
    gap: 8px;
    margin-bottom: 12px;
  }
  
  .settings-title {
    font-size: 1.2rem;
  }
  
  .settings-tabs {
    gap: 6px;
  }
  
  .settings-tab {
    min-width: 90px;
    padding: 6px 10px;
    font-size: 0.8rem;
  }
  
  .tab-icon {
    font-size: 1rem;
  }
  
  .tab-label {
    font-size: 0.8rem;
  }
  
  .settings-content {
    margin-top: 12px;
  }
}

@media (max-width: 360px) {
  .settings-container {
    margin: 2px 2px 0 2px;
    padding: 8px 6px 12px 6px;
  }
  
  .settings-tab {
    min-width: 80px;
    padding: 5px 8px;
    font-size: 0.75rem;
  }
  
  .tab-icon {
    font-size: 0.9rem;
  }
  
  .tab-label {
    font-size: 0.75rem;
  }
}
</style> 