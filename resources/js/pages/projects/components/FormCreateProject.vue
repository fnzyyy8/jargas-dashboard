<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

import AppDatePicker from '@/components/AppDatePicker.vue';

const dialog = ref(false);

const form = useForm({
    project_name: '',
    project_code: '',
    project_number : '',
    budget: 0,
    area: '',
    client: '',
    start_date: '',
    end_date: '',
    status: '',
});

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

const submitData = () => {
    form.start_date = dateMulai.value
        ? dateMulai.value.toLocaleDateString('en-CA')
        : '';
    form.end_date = dateSelesai.value
        ? dateSelesai.value.toLocaleDateString('en-CA')
        : '';

    form.post('/projects', {
        onSuccess: () => {
            dialog.value = false;
            form.reset();
            dateMulai.value = null;
            dateSelesai.value = null;
        },
    });
};
</script>

<template>
    <v-dialog
        max-width="700"
        transition="dialof-center-transition"
        v-model="dialog"
    >
        <template v-slot:activator="{ props: activatorProps }">
            <v-btn
                v-bind="activatorProps"
                text="Create Project"
                color="success"
                prepend-icon="mdi-plus"
            />
        </template>

        <v-card>
            <v-card-title>
                <span>Buat Project</span>
            </v-card-title>
            <v-spacer />

            <v-card-item>
                <v-form @submit.prevent="submitData" id="project-form">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <v-text-field
                                v-model="form.project_code"
                                label="Kode Proyek"
                                :error-messages="form.errors.project_code"
                            />
                        </div>
                        <div>
                            <v-text-field
                                v-model="form.project_number"
                                label="Nomor SPK"
                                :error-messages="form.errors.project_number"
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
                                class="text-sm text-red-500"
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
                                class="text-sm text-red-500"
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
