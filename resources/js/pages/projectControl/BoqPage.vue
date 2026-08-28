<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import FormCreateBoq from '@/pages/projectControl/components/boq/FormCreateBoq.vue';

const tHead = ['No. SPK', 'Area', 'Nama Pekerjaan', 'Detail Area', 'Aksi'];

const form = useForm({});
interface Boqs {
    id: number;
    project_number: string;
    project_area: string;
    project_name: string;
    detailed_area: string;
}

interface Projects {
    id: number;
    project_name: string;
    category: string;
}

defineProps<{
    boqs: Boqs[];
    categories: string[];
    projects: Projects[];
}>();

const openCreateDialog = ref(false);
const selectedIdToDelete = ref<number | null>(null);
const deleteDialog = ref(false);

const openDeleteDialog = (id: number) => {
    selectedIdToDelete.value = id;
    deleteDialog.value = true;
};
const handleDelete = () => {
    if (!selectedIdToDelete.value) {
        return;
    } else {
        form.delete(`/project-control/boq/${selectedIdToDelete.value}`, {
            onSuccess: () => {
                deleteDialog.value = false;
                selectedIdToDelete.value = null;
            },
        });
    }
};
</script>

<template>
    <v-card>
        <div class="m-3">
            <div class="flex justify-end">
                <v-btn
                    prepend-icon="mdi-plus"
                    color="success"
                    @click="openCreateDialog = true"
                    >Create Boq</v-btn
                >
                <FormCreateBoq
                    v-model="openCreateDialog"
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
                                            @click=""
                                        />
                                        <v-list-item
                                            prepend-icon="mdi-delete"
                                            title="Delete"
                                            base-color="error"
                                            @click="openDeleteDialog(boq.id)"
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
        v-model="deleteDialog"
        :loading="form.processing"
        @confirm="handleDelete"
    />
</template>

<style scoped></style>
