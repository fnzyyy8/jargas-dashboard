<script setup lang="ts">
import { toRef, watch } from 'vue';
import { useBoqFormActions } from '@/pages/projectControl/composables/boq/useBoqFormActions';
import type { FormBoqProps } from '@/pages/projectControl/types/boq.type';

const props = withDefaults(defineProps<FormBoqProps>(), {
    categories: () => [],
    projects: () => [],
});

const dialog = defineModel<boolean>('modelValue', { default: false });
const projectRef = toRef(props, 'projects');
const categoriesRef = toRef(props, 'categories');

const { form, selectedCategory, filteredProjects, submitForm, resetForm } =
    useBoqFormActions(projectRef, categoriesRef, () => {
        dialog.value = false;
    });

watch(dialog, (isOpen) => {
    if (isOpen === false) {
        resetForm();
    }
});
</script>

<template>
    <v-dialog
        v-model="dialog"
        width="700"
        transition="dialog-center-transition"
    >
        <v-card>
            <v-form @submit.prevent="submitForm">
                <v-card-title>
                    <span> Tambahkan Boq </span>
                </v-card-title>
                <v-card-item>
                    <div class="my-3">
                        <v-autocomplete
                            v-model="selectedCategory"
                            :items="props.categories"
                            density="comfortable"
                            variant="outlined"
                            label="Category"
                            clearable
                        />
                        <v-autocomplete
                            v-model="form.project_id"
                            :items="filteredProjects"
                            item-title="project_name"
                            item-value="id"
                            density="comfortable"
                            variant="outlined"
                            :disabled="!selectedCategory"
                            label="Project"
                            :error-messages="form.errors.project_id"
                            clearable
                        />
                        <v-text-field
                            v-model="form.detailed_area"
                            density="comfortable"
                            variant="outlined"
                            label="Detailed Area"
                            :error-messages="form.errors.detailed_area"
                        />
                        <v-checkbox
                            v-model="form.isMultipleCustomer"
                            :error-messages="form.errors.isMultipleCustomer"
                            :false-value="false"
                            :true-value="true"
                            label="Cakupan pelanggan lebih dari satu"
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
