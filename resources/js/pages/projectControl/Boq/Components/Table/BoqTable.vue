<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import type { Boq } from '@/pages/projectControl/Boq/Types/boq.type';
import { route } from 'ziggy-js';

defineProps<{
    boqs: Boq[];
}>();

const emit = defineEmits<{
    (e: 'add-boq'): void;
    (e: 'view-boq', id: number): void;
    (e: 'update-boq', boq: Boq): void;
    (e: 'delete-boq', id: number): void;
}>();

const tHead = [
    'Cust',
    'No. SPK',
    'Area',
    'Nama Pekerjaan',
    'Detail Area',
    'Aksi',
];
</script>

<template>
    <v-card>
        <div class="m-3">
            <div class="flex justify-end">
                <v-btn
                    prepend-icon="mdi-plus"
                    color="success"
                    @click="emit('add-boq')"
                    >Tambahkan Boq</v-btn
                >
            </div>
            <div class="mt-3">
                <v-table>
                    <thead>
                        <tr>
                            <th v-for="(head, index) in tHead" :key="index">
                                {{ head }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="boq in boqs" :key="boq.id">
                            <td>
                                <VIcon
                                    v-if="boq.isMultipleCustomer"
                                    icon="mdi-account-group"
                                />

                                <VIcon v-else icon="mdi-account" />
                            </td>
                            <td>{{ boq.project_number }}</td>
                            <td>{{ boq.project_area }}</td>
                            <td>{{ boq.project_name }}</td>
                            <td>{{ boq.detailed_area }}</td>
                            <td>
                                <v-menu>
                                    <template v-slot:activator="{ props }">
                                        <v-btn
                                            icon="mdi-dots-vertical"
                                            variant="text"
                                            size="small"
                                            v-bind="props"
                                        ></v-btn>
                                    </template>
                                    <v-list>
                                        <v-list-item
                                            prepend-icon="mdi-eye"
                                            title="View"
                                            base-color="grey"
                                            @click="emit('view-boq', boq.id)"
                                        />
                                        <v-list-item
                                            prepend-icon="mdi-pencil"
                                            title="Edit"
                                            base-color="warning"
                                            @click="emit('update-boq', boq)"
                                        />
                                        <v-list-item
                                            prepend-icon="mdi-delete"
                                            title="Delete"
                                            base-color="error"
                                            @click="emit('delete-boq', boq.id)"
                                        />
                                    </v-list>
                                </v-menu>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </div>
        </div>
    </v-card>
</template>

<style scoped></style>
