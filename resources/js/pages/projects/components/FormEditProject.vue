<script setup lang="ts">
import AppDatePicker from '@/components/AppDatePicker.vue';
import { useProjectEditActions } from '@/pages/projects/composables/useProjectEditActions';

const {
    form,
    isEditOpen,
    dateEnd,
    dateStart,
    minDateEnd,
    openEditModal,
    submit,
} = useProjectEditActions();

defineExpose({ openEditModal });
</script>

<template>
    <v-dialog
        max-width="700"
        transition="dialog-center-transition"
        v-model="isEditOpen"
    >
        <v-card>
            <v-form @submit.prevent="submit" id="project-form">
                <v-card-title>
                    <span>Edit Project</span>
                </v-card-title>
                <v-spacer />

                <v-card-item>
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
                                v-model="dateStart"
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
                                v-model="dateEnd"
                                label="Tanggal Selesai"
                                :min="minDateEnd"
                            />
                            <span
                                v-if="form.errors.end_date"
                                class="text-red-500"
                                >{{ form.errors.end_date }}</span
                            >
                        </div>
                    </div>
                </v-card-item>
                <v-card-actions class="flex justify-end mx-2">
                    <div class="flex gap-2">
                        <v-btn
                            text="Simpan"
                            color="success"
                            variant="flat"
                            :loading="form.processing"
                            type="submit"
                        />
                        <v-btn
                            text="Batal"
                            color="error"
                            variant="flat"
                            @click="isEditOpen = false"
                        />
                    </div>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
