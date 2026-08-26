<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { formatNumber } from '@/composable/ConvertRupiah';

const tHead = ['Item Detail', 'Unit', 'Volume', 'Unit Price'];
interface ProjectItem {
    id: number;
    project_name: string;
    project_categories: string;
}

const { useRupiah } = formatNumber();

interface PlanItem {
    id: number;
    item_detail: string;
    unit: string;
    volume: number;
    unit_price: number;
}

const props = defineProps<{
    project_categories: string[];
    projects: ProjectItem[];
    plans: PlanItem[];
    filters?: { category?: string; idProject: number };
}>();

const selectedCategory = ref<string | null>(props.filters?.category || null);
const selectedProjects = ref<number | null>(
    props.filters?.idProject ? Number(props.filters.idProject) : null,
);

const projectOption = computed(() => {
    return props.projects
        ? props.projects.map((item) => ({
              id: item.id,
              name: item.project_name,
          }))
        : [];
});

const onCategoryChange = (val: string | null) => {
    selectedProjects.value = null;

    router.get(
        window.location.pathname,
        { category: val, idProject: null },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['projects', 'plans', 'filters'],
        },
    );
};

const onProjectChange = (val: number | null) => {
    router.get(
        window.location.pathname,
        { category: selectedCategory.value, idProject: val },
        {
            preserveState: true,
            preserveScroll: true,
            only: ['plans', 'filters'],
        },
    );
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
                    <v-combobox
                        v-model="selectedCategory"
                        label="Jenis Pekerjaan"
                        :items="props.project_categories"
                        density="comfortable"
                        variant="outlined"
                        hide-details="auto"
                        clearable
                        @update:model-value="onCategoryChange"
                    />
                    <v-combobox
                        v-model="selectedProjects"
                        label="Judul Pekerjaan"
                        :items="projectOption"
                        item-value="id"
                        item-title="name"
                        :return-object="false"
                        density="comfortable"
                        variant="outlined"
                        hide-details="auto"
                        clearable
                        :disabled="!selectedCategory"
                        @update:model-value="onProjectChange"
                    />
                </div>
            </v-card-item>
        </v-card>
        <v-card>
            <div></div>
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
                        <tr v-if="!plans || plans.length === 0">
                            <td :colspan="tHead.length" class="text-center">
                                Tidak ada data
                            </td>
                        </tr>
                        <tr v-else v-for="plan in plans" :key="plan.id">
                            <td>{{ plan.item_detail }}</td>
                            <td>{{ plan.unit }}</td>
                            <td>{{ plan.volume }}</td>
                            <td>{{ useRupiah(plan.unit_price) }}</td>
                        </tr>
                    </tbody>
                </v-table>
            </v-card-item>
        </v-card>
    </div>
</template>

<style scoped></style>
