<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { VTextField } from 'vuetify/components';

import AppDatePicker from '@/components/AppDatePicker.vue';

const dialog = ref(false);

const form = useForm({
    project_name: '',
    project_code: '',
    project_number: '',
    category: '',
    budget: 0,
    area: '',
    client: '',
    start_date: '',
    end_date: '',
    status: '',
    isMultipleArea: false,
});

interface FormSetup {
    density?: VTextField['$props']['density'];
    variant?: VTextField['$props']['variant'];
}

const formSetup = withDefaults(defineProps<FormSetup>(), {
    density: 'comfortable',
    variant: 'outlined',
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
        transition="dialog-center-transition"
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
                        <div class="mt-2">
                            <v-text-field
                                v-model="form.project_code"
                                :variant="formSetup.variant"
                                :density="formSetup.density"
                                label="Kode Proyek"
                                :error-messages="form.errors.project_code"
                            />
                        </div>
                        <div class="mt-2">
                            <v-text-field
                                v-model="form.project_number"
                                :variant="formSetup.variant"
                                :density="formSetup.density"
                                label="Nomor SPK"
                                :error-messages="form.errors.project_number"
                            />
                        </div>
                        <div class="col-span-2">
                            <v-combobox
                                v-model="form.category"
                                :variant="formSetup.variant"
                                :density="formSetup.density"
                                :items="['Material', 'Konstruksi']"
                                label="Kategori Proyek"
                                :error-messages="form.errors.category"
                            />
                        </div>

                        <div class="col-span-2">
                            <v-textarea
                                v-model="form.project_name"
                                :variant="formSetup.variant"
                                :density="formSetup.density"
                                label="Nama Proyek"
                                :error-messages="form.errors.project_name"
                            />
                        </div>
                        <div class="col-span-2">
                            <v-number-input
                                v-model="form.budget"
                                :variant="formSetup.variant"
                                :density="formSetup.density"
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
                                :variant="formSetup.variant"
                                :density="formSetup.density"
                                label="Area"
                                :error-messages="form.errors.area"
                            />
                        </div>
                        <div class="col-span-2">
                            <v-text-field
                                v-model="form.client"
                                :variant="formSetup.variant"
                                :density="formSetup.density"
                                label="Client"
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
                        <div>
                            <v-checkbox
                                v-model="form.isMultipleArea"
                                label="Multiple Area"
                            />
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
