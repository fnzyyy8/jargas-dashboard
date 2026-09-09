<script setup lang="ts">
import { usePlanCreateActions } from '@/pages/projectControl/Plan/Composables/usePlanCreateActions';

const dialog = defineModel<boolean>('modelValue', { default: false });
const props = defineProps<{
    boqId: number;
    isMultipleCustomer: boolean;
}>();

const { createForm, submitCreateForm } = usePlanCreateActions(
    props.boqId,
    () => props.isMultipleCustomer,
    () => {
        dialog.value = false;
    },
);

const closeModal = () => {
    dialog.value = false;
    createForm.clearErrors();
};
</script>

<template>
    <v-dialog
        v-model="dialog"
        width="700"
        transition="dialog-center-transition"
    >
        <v-card>
            <v-form @submit.prevent="submitCreateForm">
                <v-card-title>
                    <span>Buat Plan</span>
                </v-card-title>
                <v-card-item>
                    <div class="mt-2">
                        <v-autocomplete
                            v-model="createForm.customer_category"
                            :error-messages="
                                createForm.errors.customer_category
                            "
                            :disabled="!isMultipleCustomer"
                            :items="[
                                {
                                    title: 'Rumah Tangga',
                                    value: 'rumah tangga',
                                },
                                {
                                    title: 'Pelanggan Kecil',
                                    value: 'pelanggan kecil',
                                },
                                {
                                    title: 'Komersial Industri',
                                    value: 'komersial industri',
                                },
                            ]"
                            item-title="title"
                            item-value="value"
                            density="comfortable"
                            variant="outlined"
                            label="Pelanggan"
                            autocomplete="off"
                        />
                        <v-combobox
                            v-model="createForm.section"
                            :error-messages="createForm.errors.section"
                            density="comfortable"
                            variant="outlined"
                            label="Section"
                            autocomplete="off"
                        />
                        <v-combobox
                            v-model="createForm.category"
                            :error-messages="createForm.errors.category"
                            density="comfortable"
                            variant="outlined"
                            label="Category"
                            autocomplete="off"
                        />
                        <v-combobox
                            v-model="createForm.sub_category"
                            :error-messages="createForm.errors.sub_category"
                            density="comfortable"
                            variant="outlined"
                            label="Sub Category"
                            autocomplete="off"
                        />
                        <v-textarea
                            v-model="createForm.item_detail"
                            :error-messages="createForm.errors.item_detail"
                            density="comfortable"
                            variant="outlined"
                            label="Item Pekerjaan"
                        />
                        <div class="grid grid-cols-2 gap-3">
                            <v-number-input
                                v-model="createForm.volume"
                                :error-messages="createForm.errors.volume"
                                density="comfortable"
                                variant="outlined"
                                :min="0"
                                grouping="always"
                                label="Volume"
                            />
                            <v-text-field
                                v-model="createForm.unit"
                                :error-messages="createForm.errors.unit"
                                density="comfortable"
                                variant="outlined"
                                label="Satuan"
                            />
                        </div>
                        <v-number-input
                            v-model="createForm.unit_price"
                            :error-messages="createForm.errors.unit_price"
                            control-variant="hidden"
                            density="comfortable"
                            variant="outlined"
                            label="Harga Satuan"
                            :min="0"
                            grouping="always"
                            prefix="Rp"
                        />
                    </div>
                </v-card-item>
                <v-card-actions class="flex justify-end px-4">
                    <div class="flex gap-3">
                        <v-btn
                            color="success"
                            variant="flat"
                            :loading="createForm.processing"
                            type="submit"
                        >
                            Tambahkan
                        </v-btn>
                        <v-btn
                            color="error"
                            variant="flat"
                            :disabled="createForm.processing"
                            @click="closeModal"
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
