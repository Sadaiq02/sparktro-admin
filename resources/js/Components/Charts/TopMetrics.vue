<script setup>
const props = defineProps({
    metrics: {
        type: Array,
        required: false,
        default: () => [
            { id: 1, title: 'Total Employees', value: '18', change: '+6.08%', icon: 'group', changeType: 'increase' },
            { id: 2, title: 'Total Seller', value: '04', change: '-0.03%', icon: 'store', changeType: 'decrease' },
            { id: 3, title: 'Total Expenses', value: '$365.54', change: '+6.08%', icon: 'group', changeType: 'increase' },
            { id: 4, title: 'Total Deposits', value: '$0.00', change: '+6.08%', icon: 'account_balance_wallet', changeType: 'increase' },
            { id: 5, title: 'Total Product', value: '9587', change: '-0.03%', icon: 'shopping_bag', changeType: 'decrease' },
            { id: 6, title: 'Total Tasks', value: '12', change: '+6.08%', icon: 'list_alt', changeType: 'increase' },
            { id: 7, title: 'Total Order', value: '64', change: '+6.08%', icon: 'inventory_2', changeType: 'increase' },
            { id: 8, title: 'Total Sale', value: '$654.57', change: '+6.08%', icon: 'payments', changeType: 'increase' },
            { id: 9, title: 'Total Refunded', value: '$9124.25', change: '-0.03%', icon: 'refresh', changeType: 'decrease' },
            { id: 10, title: 'Total Revenue', value: '$265.35', change: '+6.08%', icon: 'bar_chart', changeType: 'increase' },
            { id: 11, title: 'New Customer', value: '842', change: '+6.08%', icon: 'group', changeType: 'increase' },
            { id: 12, title: 'Pending Order', value: '64', change: '-0.03%', icon: 'check_circle', changeType: 'decrease' },
        ]
    }
});
</script>

<template>
    <div class="top-metrics-grid">
        <div v-for="metric in metrics" :key="metric.id" class="metric-card">
            <!-- Top Section: Icon -->
            <div class="icon-section">
                <div class="icon-container">
                    <i class="material-icons-round">{{ metric.icon }}</i>
                </div>
            </div>
            
            <!-- Middle Section: Title -->
            <div class="title-section">
                <p class="metric-title">{{ metric.title }}</p>
            </div>
            
            <!-- Bottom Section: Value and Percentage -->
            <div class="bottom-section">
                <p class="metric-value">{{ metric.value }}</p>
                <div class="percentage-change" :class="{ 
                    'positive': metric.changeType === 'increase', 
                    'negative': metric.changeType === 'decrease' 
                }">
                    <span>{{ metric.change }}</span>
                    <i v-if="metric.changeType === 'increase'" class="material-icons-round">trending_up</i>
                    <i v-else-if="metric.changeType === 'decrease'" class="material-icons-round">trending_down</i>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Import Material Icons */
@import url('https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200');

/* CSS Custom Properties */
:root {
    --Hannan-Black: #1E2533;
}

/* Grid Layout - 6 columns as shown in image */
.top-metrics-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 16px;
    margin-bottom: 24px;
    width: 100%;
}

/* Individual Metric Card */
.metric-card {
    display: flex;
    flex-direction: column;
    height: 100px;
    padding: 20px;
    background: #FFF;
    border-radius: 8px;
    border: 1px solid #F3F4F6;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
    position: relative;
}

/* Icon Section - Top Right */
.icon-section {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 8px;
}

.icon-container {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #E3F2FD;
    display: flex;
    align-items: center;
    justify-content: center;
}

.material-icons-round {
    font-family: 'Material Symbols Rounded';
    font-weight: normal;
    font-style: normal;
    font-size: 16px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
    font-variation-settings: 'FILL' 1, 'GRAD' 0, 'opsz' 20;
    color: #1976D2;
}

/* Title Section - Below Icon */
.title-section {
    margin-bottom: auto;
}

.metric-title {
    color: var(--Hannan-Black, #1E2533);
    font-family: "Work Sans";
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 14px; /* 100% */
    margin: 0;
    text-align: left;
}

/* Bottom Section - Value and Percentage */
.bottom-section {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: auto;
}

.metric-value {
    color: var(--Hannan-Black, #1E2533);
    font-family: "Work Sans";
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: 24px; /* 100% */
    margin: 0;
}

.percentage-change {
    display: flex;
    align-items: center;
    gap: 2px;
    font-family: "Work Sans";
    font-size: 12px;
    font-weight: 400;
    line-height: 12px;
}

.percentage-change.positive {
    color: #10B981;
}

.percentage-change.negative {
    color: #EF4444;
}

.percentage-change .material-icons-round {
    font-size: 12px;
    color: inherit;
}

/* Responsive Design - Pixel Perfect */
@media (max-width: 1400px) {
    .top-metrics-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }
}

@media (max-width: 1200px) {
    .top-metrics-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
}

@media (max-width: 768px) {
    .top-metrics-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .metric-card {
        padding: 16px;
        height: 90px;
    }
    
    .metric-value {
        font-size: 20px;
        line-height: 20px;
    }
    
    .metric-title {
        font-size: 12px;
        line-height: 12px;
    }
    
    .icon-container {
        width: 28px;
        height: 28px;
    }
    
    .material-icons-round {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .top-metrics-grid {
        grid-template-columns: 1fr;
        gap: 8px;
    }
    
    .metric-card {
        padding: 14px;
        height: 80px;
    }
    
    .metric-value {
        font-size: 18px;
        line-height: 18px;
    }
    
    .metric-title {
        font-size: 11px;
        line-height: 11px;
    }
    
    .icon-container {
        width: 24px;
        height: 24px;
    }
    
    .material-icons-round {
        font-size: 12px;
    }
}

/* Ensure proper spacing and alignment */
.metric-card > * {
    flex-shrink: 0;
}

/* Fix for very small screens */
@media (max-width: 360px) {
    .top-metrics-grid {
        grid-template-columns: 1fr;
    }
    
    .metric-card {
        padding: 12px;
        height: 75px;
    }
}
</style>