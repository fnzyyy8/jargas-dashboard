<script setup lang="ts">
import { formatNumber } from '@/composable/ConvertRupiah';
import type { Plan } from '@/pages/projectControl/Plan/Types/plan.type';

const tHead = ['Detail Pekerjaan', 'Satuan', 'Volume', 'Harga Satuan', 'Aksi'];
defineProps<{
    plans: Plan[] | undefined;
}>();
const { useNumber, useRupiah } = formatNumber();

const emit = defineEmits<{
    (e: 'view-plan', planId: number): void;
    (e: 'create-plan'): void;
    (e: 'delete-plan', planId: number): void;
    (e: 'filter'): void;
}>();
</script>

<template>
    <div class="grid grid-cols-2 py-2">
        <div class="flex items-center gap-3">
            <v-text-field
                prepend-inner-icon="mdi-magnify"
                placeholder="Search"
                density="compact"
                variant="outlined"
                max-width="250px"
                hide-details
                clearable
            />
            <v-btn
                prepend-icon="mdi-filter-outline"
                color="primary"
                variant="outlined"
                text="filter"
                @click="emit('filter')"
            />
        </div>
        <div class="flex justify-end">
            <v-btn
                prepend-icon="mdi-plus"
                color="success"
                @click="emit('create-plan')"
                >Create Plan</v-btn
            >
        </div>
    </div>
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
                                    @click="emit('view-plan', plan.id)"
                                />
                                <v-list-item
                                    prepend-icon="mdi-delete"
                                    title="Delete"
                                    base-color="error"
                                    @click.prevent="
                                        () => emit('delete-plan', plan.id)
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
</template>

<style scoped></style>
