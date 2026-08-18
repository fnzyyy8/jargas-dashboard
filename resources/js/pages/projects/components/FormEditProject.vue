<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

import AppDatePicker from '@/components/AppDatePicker.vue';

const dialog = ref(false);

const form = useForm({
    id: 0,
    project_name: '',
    project_code: '',
    project_number: '',
    budget: 0,
    area: '',
    client: '',
    start_date: '',
    end_date: '',
});

interface Project {
    id: number;
    project_name: string;
    project_code: string;
    project_number: string;
    budget: number;
    area: string;
    client: string;
    start_date: string;
    end_date: string;
}

const dateMulai = ref<Date | null>(null);
const dateSelesai = ref<Date | null>(null);

const minDateSelesai = computed(() => dateMulai.value || undefined);

watch(dateMulai, (newMulai) => {
    if (newMulai) {
        if (!dateSelesai.value) {
            dateSelesai.value = new Date(newMulai);
        } else if (dateSelesai.value < newMulai) {
            dateSelesai.value = new Date(newMulai);
        }
    }
});

const openEditModal = (project: Project) => {
    form.id = project.id;
    form.project_name = project.project_name;
    form.project_code = project.project_code;
    form.project_number = project.project_number;
    form.budget = project.budget;
    form.area = project.area;
    form.client = project.client;

    dateMulai.value = new Date(project.start_date);
    dateSelesai.value = new Date(project.end_date);
    dialog.value = true;
};

defineExpose({ openEditModal });

const submitData = () => {
    form.start_date = dateMulai.value
        ? dateMulai.value.toLocaleDateString('en-CA')
        : '';
    form.end_date = dateSelesai.value
        ? dateSelesai.value.toLocaleDateString('en-CA')
        : '';

    form.put(`/projects/${form.id}`, {
        onSuccess: () => {
            dialog.value = false;
            form.reset();
        },
    });
};
</script>

<template>
    <v-dialog
        max-width="700"
        transition="dialog-center-transition"
        v-model="dialog"
    >
        <v-card>
            <v-card-title>
                <span>Edit Project</span>
            </v-card-title>
            <v-spacer />

            <v-card-item>
                <v-form @submit.prevent="submitData" id="project-form">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <v-text-field
                                label="Kode Proyek"
                                v-model="form.project_code"
                                :error-messages="form.errors.project_code"
                                disabled
                            />
                        </div>
                        <div>
                            <v-text-field
                                label="Nomor SPK"
                                v-model="form.project_number"
                                :error-messages="form.errors.project_number"
                                disabled
                            />
                        </div>
                        <div class="col-span-2">
                            <v-textarea
                                v-model="form.project_name"
                                label="Nama Proyek"
                                :error-messages="form.errors.project_name"
                            />
                        </div>
                        <div class="col-span-2">
                            <v-number-input
                                v-model="form.budget"
                                label="Anggaran"
                                :error-messages="form.errors.budget"
                                prefix="Rp"
                                controlVariant="stacked"
                                grouping="always"
                                inset
                                :min="0"
                            />
                        </div>
                        <div class="col-span-2">
                            <v-text-field
                                v-model="form.area"
                                label="Area"
                                :error-messages="form.errors.area"
                            />
                        </div>
                        <div class="col-span-2">
                            <v-text-field
                                label="Client"
                                v-model="form.client"
                                :error-messages="form.errors.client"
                            />
                        </div>
                        <div>
                            <AppDatePicker
                                v-model="dateMulai"
                                label="Tanggal Mulai"
                            />
                            <span
                                v-if="form.errors.start_date"
                                class="text-red-500"
                                >{{ form.errors.start_date }}</span
                            >
                        </div>
                        <div>
                            <AppDatePicker
                                v-model="dateSelesai"
                                label="Tanggal Selesai"
                                :min="minDateSelesai"
                            />
                            <span
                                v-if="form.errors.end_date"
                                class="text-red-500"
                                >{{ form.errors.end_date }}</span
                            >
                        </div>
                    </div>
                </v-form>
            </v-card-item>
            <v-card-actions>
                <v-btn
                    text="Simpan"
                    color="success"
                    variant="flat"
                    :loading="form.processing"
                    @click="submitData"
                />
                <v-btn
                    text="Batal"
                    color="error"
                    variant="flat"
                    @click="dialog = false"
                />
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
