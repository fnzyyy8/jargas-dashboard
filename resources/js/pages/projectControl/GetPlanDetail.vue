<script setup lang="ts">
import { usePlanActions } from '@/pages/projectControl/composables/plan/usePlanActions';
import type { Boq, Plan } from '@/pages/projectControl/types/plan.type';

const tHead = ['Detail Pekerjaan', 'Satuan', 'Volume', 'Harga Satuan'];

defineProps<{
    project_detail: Boq;
    plans: Plan[];
}>();

const { redirectToBoq } = usePlanActions();
</script>

<template>
    <div class="flex flex-col gap-3">
        <v-card>
            <v-card-item>
                <div class="my-3 grid grid-cols-2 gap-3">
                    <div class="container-project">
                        <h4>Nomor SPK</h4>
                        <div class="project-detail">
                            <P>{{ project_detail.project.project_number }}</P>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Nama Pekerjaan</h4>
                        <div class="project-detail">
                            <P>{{ project_detail.project.project_name }}</P>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Area</h4>
                        <div class="project-detail">
                            <P>{{ project_detail.project.area }}</P>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Client</h4>
                        <div class="project-detail">
                            <P>{{ project_detail.project.client }}</P>
                        </div>
                    </div>
                    <div class="container-project">
                        <h4>Detail Area</h4>
                        <div class="project-detail">
                            <P>{{ project_detail.detailed_area }}</P>
                        </div>
                    </div>
                    <div
                        class="container-project flex items-end justify-end gap-3"
                    >
                        <div class="flex">
                            <v-btn prepend-icon="mdi-plus" color="success"
                                >Tambahkan Item</v-btn
                            >
                        </div>
                        <div class="flex">
                            <v-btn
                                prepend-icon="mdi-arrow-left"
                                color="warning"
                                @click="redirectToBoq"
                                >Kembali</v-btn
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
                        <tr v-for="item in plans" :key="item.id">
                            <td>{{ item.item_detail }}</td>
                            <td>{{ item.unit }}</td>
                            <td>{{ item.volume }}</td>
                            <td>{{ item.unit_price }}</td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card-item>
        </v-card>
    </div>
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
