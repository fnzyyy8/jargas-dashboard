<script setup lang="ts">
import DoughnutChart from '@/components/DoughnutChart.vue';

interface StatusChartData {
    name: string;
    value: number;
    color?: string;
}

defineProps<{
    page_title: string;
    project_statuses: StatusChartData[];
}>();
</script>

<template>
    <div class="grid grid-flow-row grid-cols-4 gap-3">
        <div class="col-span-1">
            <v-card>
                <v-card-title>
                    <h1>PROJECT STATUS</h1>
                </v-card-title>
                <v-card-text>
                    <DoughnutChart
                        v-if="project_statuses && project_statuses.length > 0"
                        :data="project_statuses"
                    />
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<style scoped></style>
