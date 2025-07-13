<template>
  <div class="theme-setting">
    <h3 class="section-title">Theme</h3>
    <p class="section-desc">Customization according to your preferences.</p>
    <div class="theme-cards">
      <div
        v-for="theme in themes"
        :key="theme.key"
        :class="['theme-card', { selected: selectedTheme === theme.key }]"
        @click="selectedTheme = theme.key"
      >
        <div class="theme-visual" :class="theme.key"></div>
        <div class="theme-label-row">
          <span class="theme-radio">
            <input type="radio" :checked="selectedTheme === theme.key" />
            <span class="custom-radio"></span>
          </span>
          <span class="theme-label">{{ theme.label }}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
const themes = [
  { key: 'system', label: 'Default to System' },
  { key: 'light', label: 'Light Theme' },
  { key: 'dark', label: 'Dark Theme' },
];
const selectedTheme = ref('system');
</script>

<style scoped>
.theme-setting {
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
.theme-cards {
  display: flex;
  gap: 24px;
  flex-wrap: wrap;
}
.theme-card {
  flex: 1 1 0;
  min-width: 240px;
  background: #f8fafc;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  padding: 24px 16px 18px 16px;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: border 0.2s, box-shadow 0.2s;
  box-shadow: 0 2px 8px 0 rgba(10,151,176,0.06);
  margin-bottom: 0;
}
.theme-card.selected {
  border-color: #0a97b0;
  box-shadow: 0 0 0 2px #e6f7fa;
}
.theme-visual {
  width: 220px;
  height: 90px;
  border-radius: 8px;
  margin-bottom: 16px;
  background: linear-gradient(90deg, #e6f7fa 50%, #23293a 50%);
  border: 1.5px solid #d1d5db;
}
.theme-card.light .theme-visual {
  background: #e6f7fa;
}
.theme-card.dark .theme-visual {
  background: #23293a;
}
.theme-label-row {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 12px;
}
.theme-radio {
  position: relative;
  display: flex;
  align-items: center;
}
.theme-radio input[type="radio"] {
  opacity: 0;
  position: absolute;
}
.custom-radio {
  width: 18px;
  height: 18px;
  border: 2px solid #bfc9d1;
  border-radius: 50%;
  background: #fff;
  display: inline-block;
  margin-right: 4px;
}
.theme-card.selected .custom-radio {
  border-color: #0a97b0;
  background: radial-gradient(circle at center, #0a97b0 60%, #fff 61%);
}
.theme-label {
  font-size: 1.08rem;
  font-weight: 500;
}

/* Responsive styles */
@media (max-width: 900px) {
  .theme-cards {
    flex-direction: column;
    gap: 18px;
  }
  .theme-card {
    min-width: unset;
    width: 100%;
    padding: 18px 8px 14px 8px;
  }
  .theme-visual {
    width: 100%;
    min-width: 180px;
    max-width: 320px;
    height: 70px;
  }
}
@media (max-width: 600px) {
  .theme-setting {
    padding: 0 2px;
  }
  .section-title {
    font-size: 1.05rem;
    margin-bottom: 8px;
  }
  .section-desc {
    font-size: 0.98rem;
    margin-bottom: 10px;
  }
  .theme-cards {
    flex-direction: column;
    gap: 12px;
  }
  .theme-card {
    width: 100%;
    min-width: unset;
    padding: 14px 2px 10px 2px;
  }
  .theme-visual {
    width: 100%;
    min-width: 120px;
    max-width: 220px;
    height: 48px;
  }
  .theme-label-row {
    margin-top: 8px;
  }
  .theme-label {
    font-size: 1rem;
  }
}
</style> 