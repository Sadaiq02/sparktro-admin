<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  subtitle: {
    type: String,
    required: true
  },
  value: {
    type: String,
    required: true
  },
  change: {
    type: String,
    required: true
  },
  icon: {
    type: String,
    required: true
  },
  color: {
    type: String,
    default: 'primary'
  }
});

const getColorClasses = (color) => {
  const classes = {
    primary: {
      bg: 'bg-primary/10',
      icon: 'text-primary',
      text: 'text-primary'
    },
    success: {
      bg: 'bg-success/10',
      icon: 'text-success',
      text: 'text-success'
    },
    warning: {
      bg: 'bg-warning/10',
      icon: 'text-warning',
      text: 'text-warning'
    },
    danger: {
      bg: 'bg-danger/10',
      icon: 'text-danger',
      text: 'text-danger'
    }
  };
  return classes[color] || classes.primary;
};
</script>

<template>
  <div class="card p-5">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div :class="[getColorClasses(color).bg, 'w-10 h-10 rounded-lg flex items-center justify-center']">
          <i :class="['material-icons-outlined text-xl', getColorClasses(color).icon]">{{ icon }}</i>
        </div>
        <div>
          <h3 class="text-text-primary text-sm font-medium">{{ title }}</h3>
          <p class="text-text-secondary text-xs mt-0.5">{{ subtitle }}</p>
        </div>
      </div>
      <div class="text-right">
        <p class="text-text-primary text-lg font-semibold">{{ value }}</p>
        <p :class="['text-xs font-medium mt-0.5', getColorClasses(color).text]">{{ change }}</p>
      </div>
    </div>
  </div>
</template>