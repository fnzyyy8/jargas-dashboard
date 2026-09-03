<script setup lang="ts">
import { onMounted } from 'vue';
import { formatNumber } from '@/composable/ConvertRupiah';
import FormCreatePlanDetail from '@/pages/projectControl/components/planDetail/FormCreatePlanDetail.vue';
import { usePlanDetailAction } from '@/pages/projectControl/composables/planDetail/usePlanDetailAction';
import type { Plans } from '@/pages/projectControl/types/plan.detail';
import { useBreadcrumbStore } from '@/stores/useBreadcrumbStore';
import { route } from 'ziggy-js';

const breadcrumb = useBreadcrumbStore();

const props = defineProps<{
    plans: Plans;
}>();

const { useRupiah } = formatNumber();

const { isCreateOpen } = usePlanDetailAction();

onMounted(() => {
    const boqId = props.plans.boq_id;
    breadcrumb.setBreadcrumbs([
        {
            title: 'BOQ',
            href: route('boq'),
        },
        {
            title: 'PLAN',
            href: boqId ? route('plan.show', boqId) : '#',
        },
        {
            title: 'PLAN DETAIL',
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
                    <span>SPK : {{ plans.boq?.project?.project_number }}</span>
                    <span> | </span>
                    <span>CLIENT : {{ plans.boq?.project?.client }}</span>
                    <span> | </span>
                    <span
                        >AREA :
                        {{ plans.boq?.project?.area.toUpperCase() }}</span
                    >
                    <span> | </span>
                    <span
                        >Detail Area :
                        {{ plans.boq?.detailed_area }}</span
                    >
                </div>
            </div>
        </v-card>
        <v-card class="col-span-1">
            <div class="p-3">
                <div
                    class="grid grid-cols-[auto_1fr] items-center gap-x-3 gap-y-1"
                >
                    <span class="text-md">Detailed Area</span>
                    <span class="text-md">
                        : {{ plans.boq?.detailed_area }}
                    </span>

                    <span class="text-md">Category</span>
                    <span class="text-md">
                        : {{ plans.customer_category.toUpperCase() }}
                    </span>

                    <span class="text-md">Section</span>
                    <span class="text-md"> : {{ plans.section }} </span>

                    <span class="text-md">Category</span>
                    <span class="text-md"> : {{ plans.category ?? '-' }} </span>

                    <span class="text-md">Sub Category</span>
                    <span class="text-md">
                        : {{ plans.sub_category ?? '-' }}
                    </span>

                    <span class="text-md">Deskripsi Item</span>
                    <span class="text-md"> : {{ plans.item_detail }} </span>
                </div>
                <div class="my-3">
                    <v-divider />
                </div>
                <div
                    class="grid grid-cols-[auto_1fr] items-center gap-x-3 gap-y-1"
                >
                    <span class="text-md">Target Volume</span>
                    <span class="text-md">
                        : {{ plans.volume }} {{ plans.unit }}
                    </span>
                    <span class="text-md">Harga Satuan</span>
                    <span class="text-md">
                        : {{ useRupiah(plans.unit_price) }} / {{ plans.unit }}
                    </span>
                    <span class="text-md">Total Nilai</span>
                    <span class="text-md">
                        : {{ useRupiah(plans.unit_price * plans.volume) }}
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
                    <span class="text-md"> : 0 {{ plans.unit }} (0%) </span>
                    <span class="text-md">Sisa Alokasi</span>
                    <span class="text-md"> : 12 {{ plans.unit }} </span>
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
                            <tr>
                                <td>23-01-2026</td>
                                <td>1 ls</td>
                                <td>8.33 %</td>
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
                        </tbody>
                    </v-table>
                </div>
            </div>
        </v-card>
    </div>
</template>

<style scoped></style>
