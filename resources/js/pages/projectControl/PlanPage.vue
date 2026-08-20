<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import FormCreatePlan from '@/pages/projectControl/components/FormCreatePlan.vue';

const tableHead = ['Item Pekerjaan', 'Satuan', 'Volume', 'Harga Satuan'];

interface ProjectItem {
    id: number;
    project_name: string;
    category: string;
}

const props = defineProps<{
    categories: string[];
    projects: ProjectItem[];
}>();

const form = useForm({
    category: '',
    project_id: null as number | null,
});

const filteredProjects = computed(() => {
    if (!form.category) {
        return props.projects;
    } else {
        return props.projects.filter((p) => p.category === form.category);
    }
});

const onCategoryChange = () => {
    form.project_id = null;
};
</script>

<template>
    <div class="flex flex-col gap-3">
        <v-card>
            <v-card-title>
                <h4>Project Plan</h4>
            </v-card-title>
            <v-card-item>
                <div class="mt-3 grid grid-cols-2 gap-3">
                    <v-select
                        v-model="form.category"
                        label="Jenis Pekerjaan"
                        :items="props.categories"
                        density="comfortable"
                        variant="outlined"
                        hide-details="auto"
                        @update:model-value="onCategoryChange"
                    />
                    <v-select
                        label="Pilih Project"
                        v-model="form.project_id"
                        :items="filteredProjects"
                        item-title="project_name"
                        item-value="id"
                        density="comfortable"
                        variant="outlined"
                        hide-details="auto"
                        :disabled="!form.category"
                    />
                </div>
            </v-card-item>
        </v-card>
        <v-card>
            <div>
                <v-card-title class="py-5">
                    <div class="grid grid-cols-2">
                        <div class="grid grid-cols-3 gap-2">
                            <v-autocomplete
                                label="Section"
                                variant="outlined"
                                density="comfortable"
                            />

                            <v-autocomplete
                                label="Category"
                                variant="outlined"
                                density="comfortable"
                            />

                            <v-autocomplete
                                label="Sub Category"
                                variant="outlined"
                                density="comfortable"
                            />
                        </div>
                        <div class="flex justify-end">
                            <FormCreatePlan />
                        </div>
                    </div>
                </v-card-title>
            </div>
            <v-card-item>
                <v-table>
                    <thead>
                        <tr>
                            <th v-for="(item, index) in tableHead" :key="index">
                                {{ item }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card-item>
        </v-card>
    </div>
</template>

<style scoped></style>
