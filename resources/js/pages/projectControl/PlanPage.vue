<script setup lang="ts">
import { onMounted } from 'vue';
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import { formatNumber } from '@/composable/ConvertRupiah';
import FormCreatePlan from '@/pages/projectControl/components/plan/FormCreatePlan.vue';
import { usePlanActions } from '@/pages/projectControl/composables/plan/usePlanActions';
import type { Boq, Plan } from '@/pages/projectControl/types/plan.type';
import { useBreadcrumbStore } from '@/stores/useBreadcrumbStore';
import { route } from 'ziggy-js';

const tHead = ['Detail Pekerjaan', 'Satuan', 'Volume', 'Harga Satuan', 'Aksi'];

const { useRupiah, useNumber } = formatNumber();

defineProps<{
    project_detail: Boq;
    plans?: Plan[];
}>();

const {
    isCreateOpen,
    isDeleteOpen,
    deleteLoading,
    confirmDeleteModal,
    openDeleteModal,
    directToPlanDetail,
} = usePlanActions();

const breadcrumb = useBreadcrumbStore();

onMounted(() => {
    breadcrumb.setBreadcrumbs([
        {
            title: 'BOQ',
            href: route('boq'),
        },
        {
            title: 'PLAN',
            disabled: true,
        },
    ]);
});
</script>

<template>
    <FormCreatePlan
        v-model="isCreateOpen"
        :boq-id="project_detail.id"
        :is-multiple-customer="Boolean(project_detail.isMultipleCustomer)"
    />
    <div class="flex flex-col gap-3">
        <v-card>
            <v-card-item>
                <div class="my-3 grid grid-cols-2 gap-3">
                    <div class="container-project">
                        <h4>Nomor SPK</h4>
                        <div class="project-detail">
                            <p>{{ project_detail.project.project_number }}</p>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Nama Pekerjaan</h4>
                        <div class="project-detail">
                            <p>{{ project_detail.project.project_name }}</p>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Area</h4>
                        <div class="project-detail">
                            <p>{{ project_detail.project.area }}</p>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Client</h4>
                        <div class="project-detail">
                            <p>{{ project_detail.project.client }}</p>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Detail Area</h4>
                        <div class="project-detail">
                            <p>{{ project_detail.detailed_area }}</p>
                        </div>
                    </div>
                    <div
                        class="container-project flex items-end justify-end gap-3"
                    >
                        <div class="flex">
                            <v-btn
                                prepend-icon="mdi-plus"
                                color="success"
                                @click="isCreateOpen = true"
                                >Tambahkan Item</v-btn
                            >
                        </div>
                    </div>
                </div>
            </v-card-item>
        </v-card>
        <v-card>
            <v-card-item>
                <v-table>
                    <thead>
                        <tr>
                            <th v-for="(item, index) in tHead" :key="index">
                                {{ item }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="plans && plans.length > 0">
                            <tr v-for="plan in plans" :key="plan.id">
                                <td>{{ plan.item_detail }}</td>
                                <td>{{ plan.unit }}</td>
                                <td>{{ useNumber(plan.volume) }}</td>
                                <td>{{ useRupiah(plan.unit_price) }}</td>
                                <td>
                                    <v-menu>
                                        <template v-slot:activator="{ props }">
                                            <v-btn
                                                v-bind="props"
                                                size="small"
                                                variant="text"
                                                icon="mdi-dots-vertical"
                                            >
                                            </v-btn>
                                        </template>
                                        <v-list>
                                            <v-list-item
                                                prepend-icon="mdi-eye"
                                                title="View"
                                                base-color="grey"
                                                @click="
                                                    directToPlanDetail(
                                                        project_detail.id,
                                                        plan.id,
                                                    )
                                                "
                                            />
                                            <v-list-item
                                                prepend-icon="mdi-delete"
                                                title="Delete"
                                                base-color="error"
                                                @click="
                                                    openDeleteModal(plan.id)
                                                "
                                            />
                                        </v-list>
                                    </v-menu>
                                </td>
                            </tr>
                        </template>
                        <tr v-else class="text-grey text-center">
                            <td :colspan="tHead.length">Tidak ada data</td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card-item>
        </v-card>
    </div>
    <ConfirmationDialog
        v-model="isDeleteOpen"
        :loading="deleteLoading"
        @confirm="confirmDeleteModal"
    />
</template>

<style scoped>
@import 'tailwindcss';
.container-project {
    @apply my-3 px-2;
}

.project-detail {
    @apply mt-2 rounded-sm border border-gray-300 bg-gray-200 p-3;
}
</style>
