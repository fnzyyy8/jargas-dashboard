<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import ConfirmationDialog from '@/components/ConfirmationDialog.vue';
import { useRupiah } from '@/composable/ConvertRupiah';
import FormCreateProject from '@/pages/projects/components/FormCreateProject.vue';
import FormEditProject from '@/pages/projects/components/FormEditProject.vue';

const formDelete = useForm({});
const formatRupiah = useRupiah();

const tableHead = [
    'Status',
    'Project Name',
    'Anggaran',
    'Area',
    'Client',
    'Mulai',
    'Selesai',
    'Aksi',
];

interface Project {
    id: number;
    status: string;
    project_name: string;
    project_code: string;
    project_number: string;
    budget: number;
    area: string;
    client: string;
    start_date: string;
    end_date: string;
}

defineProps<{
    projects: Project[];
}>();

const openEditModalRef = ref<InstanceType<typeof FormEditProject> | null>(null);

const deleteDialog = ref(false);
const selectedProject = ref<Project | null>(null);

const confirmDelete = (project: Project) => {
    selectedProject.value = project;
    deleteDialog.value = true;
};

const handleDelete = () => {
    if (!selectedProject.value) {
        return;
    }

    formDelete.delete(`/projects/${selectedProject.value.id}`, {
        onSuccess: () => {
            deleteDialog.value = false;
            selectedProject.value = null;
        },
    });
};
</script>

<template>
    <v-card>
        <div class="flex w-full justify-end p-3">
            <FormCreateProject />
            <FormEditProject ref="openEditModalRef" />
        </div>
        <v-table>
            <thead>
                <tr>
                    <th v-for="(item, index) in tableHead" :key="index">
                        {{ item }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects" :key="project.id">
                    <td>
                        <small
                            v-if="project.status === 'on progress'"
                            class="bg-warning rounded-full p-2"
                        >
                            {{ project.status }}
                        </small>
                        <small
                            v-if="project.status === 'finished'"
                            class="bg-success rounded-full p-2"
                        >
                            {{ project.status }}
                        </small>
                        <small
                            v-if="project.status === 'cancel'"
                            class="bg-error rounded-full p-2"
                        >
                            {{ project.status }}
                        </small>
                    </td>
                    <td>
                        {{ project.project_name }}
                    </td>
                    <td>
                        {{ formatRupiah.format(project.budget) }}
                    </td>
                    <td>
                        {{ project.area }}
                    </td>
                    <td>
                        {{ project.client }}
                    </td>
                    <td>
                        {{ project.start_date }}
                    </td>
                    <td>
                        {{ project.end_date }}
                    </td>
                    <td>
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
                                    prepend-icon="mdi-pencil"
                                    title="Edit"
                                    base-color="warning"
                                    @click="
                                        openEditModalRef?.openEditModal(project)
                                    "
                                />
                                <v-list-item
                                    prepend-icon="mdi-delete"
                                    title="Delete"
                                    base-color="error"
                                    @click="confirmDelete(project)"
                                />
                            </v-list>
                        </v-menu>
                    </td>
                </tr>
                <tr v-if="!projects || projects.length === 0">
                    <td
                        :colspan="tableHead.length"
                        class="py-4 text-center text-gray-500"
                    >
                        Belum ada Project
                    </td>
                </tr>
            </tbody>
        </v-table>
        <ConfirmationDialog
            v-model="deleteDialog"
            :loading="formDelete.processing"
            @confirm="handleDelete"
        />
    </v-card>
</template>

<style scoped></style>
