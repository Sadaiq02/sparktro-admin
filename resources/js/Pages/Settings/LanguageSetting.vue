<template>
  <div class="language-setting">
    <h3 class="section-title">Language</h3>
    <p class="section-desc">Manage your language preferences</p>
    <form class="language-form" @submit.prevent="onSave">
      <div class="form-row">
        <div class="form-group">
          <label for="country">Country</label>
          <select id="country" v-model="form.country" class="input">
            <option value="">Select country</option>
            <option value="United States">United States</option>
            <option value="Bangladesh">Bangladesh</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="India">India</option>
            <option value="Canada">Canada</option>
          </select>
        </div>
        <div class="form-group">
          <label for="language">Language</label>
          <select id="language" v-model="form.language" class="input">
            <option value="">Select language</option>
            <option value="English (US)">English (US)</option>
            <option value="English (UK)">English (UK)</option>
            <option value="Bangla">Bangla</option>
            <option value="Hindi">Hindi</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label for="timezone">Time Zone</label>
          <select id="timezone" v-model="form.timezone" class="input">
            <option value="">Select time zone</option>
            <option value="UTC +06:00 Dhaka, Bangladesh">(UTC +06:00) Dhaka, Bangladesh</option>
            <option value="UTC -05:00 New York, USA">(UTC -05:00) New York, USA</option>
            <option value="UTC +00:00 London, UK">(UTC +00:00) London, UK</option>
            <option value="UTC +05:30 Delhi, India">(UTC +05:30) Delhi, India</option>
          </select>
        </div>
        <div class="form-group">
          <label for="spellcheck">Spellcheck</label>
          <select id="spellcheck" v-model="form.spellcheck" class="input">
            <option value="">Select spellcheck language</option>
            <option value="English (US)">English (US)</option>
            <option value="English (UK)">English (UK)</option>
            <option value="Bangla">Bangla</option>
            <option value="Hindi">Hindi</option>
          </select>
        </div>
      </div>
      <div class="form-row no-border">
        <div>
          <button type="submit" class="save-btn">Save</button>
        </div>
      </div>
      <div v-if="showSuccess" class="success-message">Language settings saved successfully!</div>
    </form>
  </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
const form = reactive({
  country: 'United States',
  language: 'English (US)',
  timezone: 'UTC +06:00 Dhaka, Bangladesh',
  spellcheck: 'English (US)',
});
const showSuccess = ref(false);
function onSave() {
  showSuccess.value = true;
  setTimeout(() => showSuccess.value = false, 1800);
}
</script>

<style scoped>
.language-setting {
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
.language-form {
  display: flex;
  flex-direction: column;
  gap: 0;
}
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 22px;
  margin-bottom: 18px;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
label {
  font-size: 14px;
  font-weight: 500;
  color: #23293a;
  margin-bottom: 2px;
  font-family: 'Work Sans', sans-serif;
  line-height: 14px;
}
.input {
  border: 1.5px solid #e5e7eb;
  border-radius: 2px;
  padding: 10px 14px;
  font-size: 14px;
  background: #f8fafc;
  color: #23293a;
  font-family: 'Work Sans', sans-serif;
  font-weight: 500;
  line-height: 14px;
}
.save-btn {
  background: #0a97b0;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 16px 0;
  font-size: 1.08rem;
  font-weight: 700;
  cursor: pointer;
  transition: background 0.2s;
  width: 120px;
  max-width: 100%;
  display: block;
  box-shadow: none;
  letter-spacing: 0.01em;
  margin-top: 0;
}
.save-btn:hover {
  background: #087e94;
}
.success-message {
  color: #0a97b0;
  font-size: 1rem;
  font-weight: 600;
  margin-top: 16px;
  margin-left: 2px;
}
@media (max-width: 900px) {
  .form-row {
    grid-template-columns: 1fr;
    gap: 10px;
    margin-bottom: 10px;
  }
  .language-setting {
    padding: 0 2px;
  }
}
@media (max-width: 700px) {
  .save-btn {
    width: 100%;
    margin-top: 10px;
    padding: 14px 0;
    font-size: 1rem;
  }
}
</style> 