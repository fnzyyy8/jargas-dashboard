<script setup lang="ts">
import { onMounted } from 'vue';
import { formatNumber } from '@/composable/ConvertRupiah';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import FormCreatePlanDetail from '@/pages/projectControl/PlanDetail/Components/FormCreatePlanDetail.vue';
import { usePlanDetailAction } from '@/pages/projectControl/PlanDetail/Composables/usePlanDetailAction';
import type {
    PlanDetail,
    Plans,
} from '@/pages/projectControl/PlanDetail/Types/plan.detail';
import { route } from 'ziggy-js';

const { setBreadcrumbs } = useBreadcrumb();

const props = defineProps<{
    plans: Plans;
    planDetails: PlanDetail[];
}>();

const { useRupiah, useNumber } = formatNumber();

const { isCreateOpen } = usePlanDetailAction();
onMounted(() => {
    setBreadcrumbs([
        {
            title: 'BOQ',
            href: route('boq'),
        },
        {
            title: 'PLAN',
            href: route('plan.index', props.plans.boq_id),
        },
        {
            title: 'DETAIL',
            disabled: true,
        },
    ]);
});
</script>
<template>
    <FormCreatePlanDetail v-model="isCreateOpen" :plans="plans" />
    <div class="grid grid-cols-3 gap-3">
        <v-card class="col-span-3">
            <div class="flex flex-col gap-1 p-3">
                <h1>{{ plans.boq?.project?.project_name }}</h1>
                <div>
                    <span
                        ><strong>SPK</strong> :
                        {{ plans.boq?.project?.project_number }}</span
                    >
                    <span> | </span>
                    <span
                        ><strong>CLIENT</strong> :
                        {{ plans.boq?.project?.client }}</span
                    >
                    <span> | </span>
                    <span
                        ><strong>AREA</strong> :
                        {{ plans.boq?.project?.area.toUpperCase() }}</span
                    >
                    <span> | </span>
                    <span
                        ><strong> Detail Area </strong> :
                        {{ plans.boq?.detailed_area }}</span
                    >
                </div>
            </div>
        </v-card>
        <v-card class="col-span-1">
            <div class="p-3">
                <div
                    class="grid grid-cols-[auto_auto_1fr] items-start gap-x-3 gap-y-1"
                >
                    <span class="text-md">Detailed Area</span>
                    <span>:</span>
                    <span class="text-md">
                        {{ plans.boq?.detailed_area }}
                    </span>

                    <span class="text-md">Jenis Pelanggan</span>
                    <span>:</span>
                    <span class="text-md">
                        {{ plans.customer_category.toUpperCase() }}
                    </span>

                    <span class="text-md">Section</span>
                    <span>:</span>
                    <span class="text-md"> {{ plans.section }} </span>

                    <span class="text-md">Category</span>
                    <span>:</span>
                    <span class="text-md"> {{ plans.category ?? '-' }} </span>

                    <span class="text-md">Sub Category</span>
                    <span>:</span>
                    <span class="text-md">
                        {{ plans.sub_category ?? '-' }}
                    </span>

                    <span class="text-md">Deskripsi Item</span>
                    <span>:</span>
                    <span class="text-md">{{ plans.item_detail }} </span>
                </div>
                <div class="my-3">
                    <v-divider />
                </div>
                <div
                    class="grid grid-cols-[auto_auto_1fr] items-start gap-x-3 gap-y-1"
                >
                    <span class="text-md">Target Volume</span>
                    <span>:</span>
                    <span class="text-md">
                        {{ useNumber(plans.volume) }} {{ plans.unit }}
                    </span>

                    <span class="text-md">Harga Satuan</span>
                    <span>:</span>
                    <span class="text-md">
                        {{ useRupiah(plans.unit_price) }} / {{ plans.unit }}
                    </span>

                    <span class="text-md">Total Nilai</span>
                    <span>:</span>
                    <span class="text-md">
                        {{ useRupiah(plans.unit_price * plans.volume) }}
                    </span>
                </div>
            </div>
        </v-card>
        <v-card class="col-span-2">
            <div class="p-3">
                <div
                    class="grid grid-cols-[auto_1fr] items-center gap-x-3 gap-y-1"
                >
                    <span class="text-md">Total Target</span>
                    <span class="text-md">
                        : {{ plans.volume }} {{ plans.unit }}
                    </span>
                    <span class="text-md">Teralokasi</span>
                    <span class="text-md">
                        : 1 {{ plans.unit }} (
                        {{ ((1 / plans.volume) * 100).toFixed(2) }}% )
                    </span>
                    <span class="text-md">Sisa Alokasi</span>
                    <span class="text-md">
                        : {{ plans.volume - 1 }} {{ plans.unit }}
                    </span>
                </div>
                <div class="my-3">
                    <div class="flex justify-end">
                        <v-btn
                            color="primary"
                            prepend-icon="mdi-plus"
                            @click="isCreateOpen = true"
                        >
                            Tambahkan
                        </v-btn>
                    </div>
                    <v-table
                        striped="even"
                        height="300"
                        fixed-header
                        class="mt-3"
                    >
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Volume</th>
                                <th>Bobot (%)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template
                                v-if="planDetails && planDetails.length > 0"
                            >
                                <tr
                                    v-for="planDetail in planDetails"
                                    :key="planDetail.id"
                                >
                                    <td>{{ planDetail.plan_date }}</td>
                                    <td>
                                        {{ planDetail.plan_volume }}
                                        {{ plans.unit }}
                                    </td>
                                    <td>
                                        {{
                                            (
                                                (planDetail.plan_volume /
                                                    plans.volume) *
                                                100
                                            ).toFixed(2)
                                        }}
                                        %
                                    </td>
                                    <v-menu>
                                        <template v-slot:activator="{ props }">
                                            <v-btn
                                                icon="mdi-dots-vertical"
                                                variant="text"
                                                size="small"
                                                v-bind="props"
                                            />
                                        </template>
                                        <v-list>
                                            <v-list-item
                                                base-color="error"
                                                prepend-icon="mdi-delete"
                                            >
                                                Delete
                                            </v-list-item>
                                        </v-list>
                                    </v-menu>
                                </tr>
                            </template>
                            <tr v-else>
                                <td
                                    class="text-center text-gray-400"
                                    :colspan="4"
                                >
                                    Tidak ada Data
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </div>
            </div>
        </v-card>
    </div>
</template>

<style scoped></style>
