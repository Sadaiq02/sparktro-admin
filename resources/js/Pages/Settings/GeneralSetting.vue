<template>
  <div class="general-setting">
    <h3 class="section-title">General Setting</h3>
    <form class="general-form">
      <div class="form-row">
        <div class="form-group">
          <label>Site Name</label>
          <input type="text" class="input" placeholder="stackview.com/" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="input" placeholder="admin123@gmail.com" />
        </div>
        <div class="form-group">
          <label>Phone</label>
          <div class="input-group">
            <span class="flag-icon">🇧🇩</span>
            <input type="text" class="input" placeholder="+880 1936587452" />
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group file-group">
          <label>Background Image (1920px*1080px)</label>
          <div class="file-input-box">
            <label class="browse-btn">
              Browse...
              <input type="file" class="input-file" @change="onFileChange($event, 'background')" />
            </label>
            <span class="file-name">{{ fileNames.background }}</span>
            <span class="file-icon">
              <img src="/assets/A down.svg" alt="file icon" />
            </span>
          </div>
        </div>
        <div class="form-group file-group">
          <label>Logo (250px*100px)</label>
          <div class="file-input-box">
            <label class="browse-btn">
              Browse...
              <input type="file" class="input-file" @change="onFileChange($event, 'logo')" />
            </label>
            <span class="file-name">{{ fileNames.logo }}</span>
            <span class="file-icon">
              <img src="/assets/A down.svg" alt="file icon" />
            </span>
          </div>
        </div>
        <div class="form-group file-group">
          <label>Favicon (50px*50px)</label>
          <div class="file-input-box">
            <label class="browse-btn">
              Browse...
              <input type="file" class="input-file" @change="onFileChange($event, 'favicon')" />
            </label>
            <span class="file-name">{{ fileNames.favicon }}</span>
            <span class="file-icon">
              <img src="/assets/A down.svg" alt="file icon" />
            </span>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group color-group">
          <label>Text Title Color</label>
          <div class="color-input-wrapper">
            <input type="text" class="input color-text" v-model="colorValues.textTitle" />
            <img v-if="!picked.textTitle" src="/assets/color.png" class="color-wheel-icon" alt="Pick color" @click="openColorPicker('textTitle')" />
            <span v-else class="color-circle-icon" :style="{ background: colorValues.textTitle }" @click="openColorPicker('textTitle')"></span>
          </div>
        </div>
        <div class="form-group color-group">
          <label>Body Text Color</label>
          <div class="color-input-wrapper">
            <input type="text" class="input color-text" v-model="colorValues.bodyText" />
            <img v-if="!picked.bodyText" src="/assets/color.png" class="color-wheel-icon" alt="Pick color" @click="openColorPicker('bodyText')" />
            <span v-else class="color-circle-icon" :style="{ background: colorValues.bodyText }" @click="openColorPicker('bodyText')"></span>
          </div>
        </div>
        <div class="form-group color-group">
          <label>Theme Color</label>
          <div class="color-input-wrapper">
            <input type="text" class="input color-text" v-model="colorValues.theme" />
            <img v-if="!picked.theme" src="/assets/color.png" class="color-wheel-icon" alt="Pick color" @click="openColorPicker('theme')" />
            <span v-else class="color-circle-icon" :style="{ background: colorValues.theme }" @click="openColorPicker('theme')"></span>
          </div>
        </div>
      </div>
      <div class="form-row no-border">
        <div>
          <button type="button" class="update-btn">Update</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Color Picker Modal with swatches -->
  <div v-if="showColorPicker" class="color-picker-modal" @click.self="closeColorPicker">
    <div class="color-picker-content">
      <div class="color-swatches">
        <span v-for="color in colorSwatches" :key="color" :style="{ background: color }" class="swatch" @click="pickSwatchColor(color)"></span>
      </div>
      <button class="close-btn" @click="closeColorPicker">Close</button>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
const fileNames = reactive({
  background: 'image.jpg',
  logo: 'image.jpg',
  favicon: 'image.jpg',
});
const colorValues = reactive({
  textTitle: '#1E2533',
  bodyText: '#5A556E',
  theme: '#0A97B0',
});
const picked = reactive({
  textTitle: false,
  bodyText: false,
  theme: false,
});
const showColorPicker = ref(false);
const currentColorKey = ref('');
const colorSwatches = [
  '#E53935', // red
  '#FB8C00', // orange
  '#FDD835', // yellow
  '#43A047', // green
  '#00ACC1', // teal
  '#1E88E5', // blue
  '#3949AB', // indigo
  '#8E24AA', // purple
  '#D81B60', // pink
  '#F4511E', // deep orange
  '#C0CA33', // lime
  '#00897B', // dark teal
  '#6D4C41', // brown
  '#757575', // gray
  '#FFFFFF', // white
  '#23293A', // dark
];
function openColorPicker(key) {
  currentColorKey.value = key;
  showColorPicker.value = true;
}
function closeColorPicker() {
  showColorPicker.value = false;
}
function pickSwatchColor(color) {
  colorValues[currentColorKey.value] = color;
  picked[currentColorKey.value] = true;
  showColorPicker.value = false;
}
function onFileChange(e, key) {
  const file = e.target.files[0];
  fileNames[key] = file ? file.name : 'image.jpg';
}
</script>

<style scoped>
.general-setting {
  padding: 0 8px;
}
.section-title {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 18px;
  color: #23293a;
}
.general-form {
  display: flex;
  flex-direction: column;
  gap: 0;
}
.form-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 22px;
  border-bottom: 1px solid #e5e7eb;
  margin-bottom: 18px;
  padding-bottom: 0;
}
.form-row:last-child,
.form-row.no-border {
  border-bottom: none;
  margin-bottom: 0;
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
.input-group {
  display: flex;
  align-items: center;
  gap: 6px;
}
.flag-icon {
  font-size: 1.2rem;
}
.file-group .file-input-box {
  display: flex;
  align-items: center;
  border: 1.5px solid #e5e7eb;
  border-radius: 2px;
  background: #f8fafc;
  padding: 0 8px 0 0;
  height: 44px;
  width: 100%;
}
.browse-btn {
  background: transparent;
  color: #23293a;
  font-family: 'Work Sans', sans-serif;
  font-size: 14px;
  font-weight: 500;
  border: none;
  border-radius: 2px;
  padding: 0 14px;
  height: 100%;
  cursor: pointer;
  display: flex;
  align-items: center;
  position: relative;
  transition: background 0.2s;
}
.browse-btn input[type="file"] {
  display: none;
}
.file-name {
  font-size: 14px;
  color: #b0b3b9;
  margin-left: 8px;
  font-family: 'Work Sans', sans-serif;
  font-weight: 500;
  flex: 1 1 auto;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.file-icon {
  margin-left: 8px;
  display: flex;
  align-items: center;
}
.file-icon img {
  width: 20px;
  height: 20px;
}
.color-group .custom-color-input {
  display: flex;
  align-items: center;
  position: relative;
  gap: 18px;
}
.color-text {
  width: 110px;
  min-width: 90px;
  border-radius: 2px;
  font-size: 14px;
  font-family: 'Work Sans', sans-serif;
  font-weight: 500;
  color: #23293a;
  line-height: 14px;
  background: #f8fafc;
  border: 1.5px solid #e5e7eb;
  padding: 10px 14px;
}
.color-square {
  width: 48px;
  height: 48px;
  border-radius: 2px;
  border: 1.5px solid #e5e7eb;
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
}
.color-circle-label {
  display: flex;
  align-items: center;
  cursor: pointer;
}
.input-color.visually-hidden {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  border: 0;
}
.color-circle {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 2px solid #e5e7eb;
  box-shadow: 0 1px 2px rgba(44, 62, 80, 0.06);
  display: inline-block;
  background: #fff;
}
.update-btn {
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
.update-btn:hover {
  background: #087e94;
}

.color-input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  width: 100%;
}
.color-text {
  width: 100%;
  border-radius: 8px;
  font-size: 14px;
  font-family: 'Work Sans', sans-serif;
  font-weight: 500;
  color: #23293a;
  line-height: 14px;
  background: #f8fafc;
  border: 1.5px solid #e5e7eb;
  padding: 14px 44px 14px 18px;
  box-sizing: border-box;
}
.color-wheel-icon {
  position: absolute;
  right: 16px;
  width: 24px;
  height: 24px;
  cursor: pointer;
  top: 50%;
  transform: translateY(-50%);
  border-radius: 50%;
  background: #fff;
  box-shadow: 0 1px 2px rgba(44, 62, 80, 0.06);
  border: 1.5px solid #e5e7eb;
  padding: 2px;
}
.color-picker-modal {
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,0.18);
  display: flex;
  align-items: center;
  justify-content: center;
}
.color-picker-content {
  background: #fff;
  border-radius: 12px;
  padding: 32px 32px 24px 32px;
  box-shadow: 0 8px 32px rgba(44,62,80,0.12);
  display: flex;
  flex-direction: column;
  align-items: center;
}
.color-swatches {
  display: grid;
  grid-template-columns: repeat(6, 36px);
  gap: 16px;
  margin-bottom: 24px;
  justify-content: center;
}
.swatch {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 2px solid #e5e7eb;
  cursor: pointer;
  box-shadow: 0 1px 2px rgba(44, 62, 80, 0.08);
  transition: border 0.2s, box-shadow 0.2s;
  display: inline-block;
}
.swatch:hover {
  border: 2px solid #0a97b0;
  box-shadow: 0 2px 8px rgba(44,62,80,0.18);
}
.close-btn {
  margin-top: 18px;
  background: #0a97b0;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 32px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}
.close-btn:hover {
  background: #087e94;
}

.color-circle-icon {
  position: absolute;
  right: 16px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 1.5px solid #e5e7eb;
  box-shadow: 0 1px 2px rgba(44, 62, 80, 0.06);
  cursor: pointer;
  top: 50%;
  transform: translateY(-50%);
  display: inline-block;
}

/* Responsive styles */
@media (max-width: 1100px) {
  .form-row {
    grid-template-columns: 1fr 1fr;
  }
}
@media (max-width: 700px) {
  .form-row {
    grid-template-columns: 1fr;
    gap: 10px;
    margin-bottom: 10px;
  }
  .general-setting {
    padding: 0 2px;
  }
  .update-btn {
    width: 100%;
    margin-top: 10px;
    padding: 14px 0;
    font-size: 1rem;
  }
}
</style> 