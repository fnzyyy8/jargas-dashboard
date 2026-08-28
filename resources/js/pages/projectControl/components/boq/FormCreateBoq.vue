<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import type { VTextField } from 'vuetify/components';

interface ProjectOption {
    id: number;
    project_name: string;
    category?: string;
}
interface Props {
    density?: VTextField['$props']['density'];
    variant?: VTextField['$props']['variant'];
    categories: string[];
    projects: ProjectOption[];
}

const props = withDefaults(defineProps<Props>(), {
    density: 'comfortable',
    variant: 'outlined',
    categories: () => [],
    projects: () => [],
});

const dialog = defineModel<boolean>('modelValue', { default: false });
const selectedCategory = ref<string | null>(null);

const form = useForm({
    project_id: null as number | null,
    detailed_area: '',
});

const filteredProjects = computed(() => {
    if (!selectedCategory.value) {
        return props.projects;
    } else {
        return props.projects.filter(
            (p) => p.category === selectedCategory.value,
        );
    }
});

watch(selectedCategory, () => {
    form.project_id = null;
});

watch(dialog, (isOpen) => {
    if (isOpen === false) {
        form.reset();
        selectedCategory.value = null;
    }
});

const submit = () => {
    form.post('/project-control/boq', {
        preserveScroll: true,
        onSuccess: () => {
            dialog.value = false;
            form.reset();
            selectedCategory.value = null;
        },
    });
};
</script>

<template>
    <v-dialog
        v-model="dialog"
        width="700"
        transition="dialog-center-transition"
    >
        <v-card>
            <v-form @submit.prevent="submit">
                <v-card-title>
                    <span> Tambahkan Boq </span>
                </v-card-title>
                <v-card-item>
                    <div class="my-3">
                        <v-autocomplete
                            v-model="selectedCategory"
                            :items="props.categories"
                            :density="props.density"
                            :variant="props.variant"
                            label="Category"
                            clearable
                        />
                        <v-autocomplete
                            v-model="form.project_id"
                            :items="filteredProjects"
                            item-title="project_name"
                            item-value="id"
                            :density="props.density"
                            :variant="props.variant"
                            :disabled="!selectedCategory"
                            label="Project"
                            :error-messages="form.errors.project_id"
                            clearable
                        />
                        <v-text-field
                            v-model="form.detailed_area"
                            :density="props.density"
                            :variant="props.variant"
                            label="Detailed Area"
                            :error-messages="form.errors.detailed_area"
                        />
                    </div>
                </v-card-item>
                <v-card-actions class="flex justify-end">
                    <div class="mx-2 flex gap-3">
                        <v-btn
                            color="success"
                            variant="flat"
                            :loading="form.processing"
                            type="submit"
                            >Submit</v-btn
                        >
                        <v-btn
                            color="error"
                            variant="flat"
                            @click="dialog = false"
                            :disabled="form.processing"
                        >
                            Batal
                        </v-btn>
                    </div>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
