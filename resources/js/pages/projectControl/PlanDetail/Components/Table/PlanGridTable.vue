<script setup lang="ts">
import { computed } from 'vue';
import { useDistributeDate } from '@/pages/projectControl/PlanDetail/Composables/useDistributeDate';
import type {
    Boq,
    ItemDetail,
    PlanDetail,
} from '@/pages/projectControl/PlanDetail/Types/plan.detail';

const props = defineProps<{
    boq: Boq;
    planDetails: PlanDetail[];
    itemDetail: ItemDetail;
}>();

const { monthYearGroup, dateList } = useDistributeDate(
    () => props.boq.startDate,
    () => props.boq.endDate,
);

const planDetailMap = computed(() => {
    const map = new Map<string, PlanDetail>();
    props.planDetails?.forEach((plan) => {
        if (plan.date) {
            map.set(plan.date, plan);
        }
    });

    return map;
});
</script>

<template>
    <v-card flat border>
        <div class="p-3">
            <v-data-table
                :items="[props.itemDetail]"
                hide-default-footer
                density="compact"
                class="elevation-1 custom-sticky-table"
            >
                <!-- MULTI-LEVEL HEADER -->
                <template #headers>
                    <!-- BARIS HEADER 1: Nama Item & Header Bulan/Tahun -->
                    <tr>
                        <th
                            rowspan="2"
                            class="font-weight-bold border-bottom sticky-col col-1 min-w-200 text-left align-middle"
                        >
                            Nama Item
                        </th>
                        <th
                            rowspan="2"
                            class="font-weight-bold border-bottom border-left sticky-col col-2 min-w-200 text-left align-middle"
                        >
                            Volume
                        </th>
                        <th
                            rowspan="2"
                            class="font-weight-bold border-bottom border-left sticky-col col-3 min-w-200 text-left align-middle"
                        >
                            Total
                        </th>
                        <th
                            v-for="data in monthYearGroup"
                            :key="data.monthYear"
                            :colspan="data.count"
                            class="font-weight-bold border-bottom border-left text-center"
                        >
                            {{ data.monthYear }}
                        </th>
                    </tr>

                    <!-- BARIS HEADER 2: Angka Tanggal (1, 2, 3, dst.) -->
                    <tr>
                        <template
                            v-for="data in monthYearGroup"
                            :key="data.monthYear"
                        >
                            <th
                                v-for="(day, dayIdx) in data.days"
                                :key="dayIdx"
                                class="text-caption font-weight-medium border-bottom border-left day-col text-center"
                            >
                                {{ day }}
                            </th>
                        </template>
                    </tr>
                </template>

                <!-- BODY TABEL -->
                <template #item="{ item }">
                    <tr>
                        <!-- Kolom 1-3 dikunci (Sticky) -->
                        <td
                            class="font-weight-medium border-bottom sticky-col col-1 text-left"
                        >
                            Rencana
                        </td>
                        <td
                            class="font-weight-medium border-bottom sticky-col col-2 text-left"
                        >
                            {{ item.volume || '-' }}
                        </td>
                        <td
                            class="font-weight-medium border-bottom sticky-col col-3 text-left"
                        >
                            {{ item.totalVolume || '-' }}
                        </td>

                        <!-- Kolom Tanggal: Menampilkan data planDetails jika tersedia -->
                        <td
                            v-for="date in dateList"
                            :key="date"
                            class="border-left text-caption border-bottom text-center"
                        >
                            {{ planDetailMap.get(date)?.volume ?? '-' }}
                        </td>
                    </tr>
                </template>
            </v-data-table>
        </div>
    </v-card>
</template>

<style scoped>
/* HIDE SCROLLBAR (Chrome, Safari, Firefox, Edge) */
:deep(.v-table__wrapper) {
    scrollbar-width: none !important; /* Firefox */
    -ms-overflow-style: none !important; /* IE & Edge Tua */
}

:deep(.v-table__wrapper::-webkit-scrollbar) {
    display: none !important; /* Chrome, Safari, Opera & Edge Modern */
    width: 0 !important;
    height: 0 !important;
}

.border-left {
    border-left: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
}
.border-bottom {
    border-bottom: 1px solid
        rgba(var(--v-border-color), var(--v-border-opacity)) !important;
}
.align-middle {
    vertical-align: middle;
}
.min-w-200 {
    min-width: 200px;
    width: 200px;
}
.day-col {
    min-width: 45px;
}

/* === STICKY COLUMN CONFIGURATION === */
.sticky-col {
    position: sticky !important;
    background-color: rgb(var(--v-theme-surface)) !important;
    z-index: 2 !important;
}

th.sticky-col {
    z-index: 3 !important;
}

.col-1 {
    left: 0px !important;
}
.col-2 {
    left: 200px !important;
}
.col-3 {
    left: 400px !important;
    box-shadow: 2px 0 5px -2px rgba(0, 0, 0, 0.1);
}
</style>
