<script setup lang="ts">
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import FormCreateBoq from '@/pages/projectControl/components/boq/FormCreateBoq.vue';
import { useBoqActions } from '@/pages/projectControl/composables/boq/useBoqActions';

import type { Boq, Project } from '@/pages/projectControl/types';

const tHead = ['No. SPK', 'Area', 'Nama Pekerjaan', 'Detail Area', 'Aksi'];

defineProps<{
    boqs: Boq[];
    categories: string[];
    projects: Project[];
}>();

const {
    isCreateOpen,
    isDeleteOpen,
    openDeleteModal,
    confirmDeleteModal,
    deleteLoading,
} = useBoqActions();
</script>

<template>
    <v-card>
        <div class="m-3">
            <div class="flex justify-end">
                <v-btn
                    prepend-icon="mdi-plus"
                    color="success"
                    @click="isCreateOpen = true"
                    >Create Boq</v-btn
                >
                <FormCreateBoq
                    v-model="isCreateOpen"
                    :categories="categories"
                    :projects="projects"
                />
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
                                            title="Detail"
                                            base-color="grey"
                                        />
                                        <v-list-item
                                            prepend-icon="mdi-delete"
                                            title="Delete"
                                            base-color="error"
                                            @click="openDeleteModal(boq.id)"
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
    <ConfirmationDialog
        v-model="isDeleteOpen"
        :loading="deleteLoading"
        @confirm="confirmDeleteModal"
    />
</template>

<style scoped></style>
