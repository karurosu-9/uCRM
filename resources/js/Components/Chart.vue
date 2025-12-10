<script setup>
import { BarChart } from 'vue-chart-3';
import { computed, reactive } from 'vue';
import 'chart.js/auto';

const props = defineProps({
    data: Object
});

const labels = computed(() => props.data.labels);
const totals = computed(() => props.data.totals);

const barData = reactive({
    labels: labels, // ラベルには選択した範囲内の「日付」を表示
    datasets: [
        {
            label: '売上',
            data: totals, // データには「金額」を表示
            backgroundColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }
    ]
});

</script>

<template>
    <div v-show="props.data">
        <BarChart :chartData="barData" />
    </div>
</template>
