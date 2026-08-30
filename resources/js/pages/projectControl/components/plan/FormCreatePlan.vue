<script setup lang="ts">
import { usePlanFormActions } from '@/pages/projectControl/composables/plan/usePlanFormActions';

const dialog = defineModel<boolean>('modelValue', { default: false });
const props = defineProps<{
    boqId: number;
}>();

const { form, submitForm } = usePlanFormActions();

const handleSubmit = () => {
    submitForm(props.boqId, () => {
        dialog.value = false;
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
            <v-form @submit.prevent="handleSubmit">
                <v-card-title>
                    <span>Buat Plan</span>
                </v-card-title>
                <v-card-item>
                    <div class="mt-2">
                        <v-combobox
                            v-model="form.section"
                            :error-messages="form.errors.section"
                            density="comfortable"
                            variant="outlined"
                            label="Section"
                        />
                        <v-combobox
                            v-model="form.category"
                            :error-messages="form.errors.category"
                            density="comfortable"
                            variant="outlined"
                            label="Category"
                        />
                        <v-combobox
                            v-model="form.sub_category"
                            :error-messages="form.errors.sub_category"
                            density="comfortable"
                            variant="outlined"
                            label="Sub Category"
                        />
                        <v-textarea
                            v-model="form.item_detail"
                            :error-messages="form.errors.item_detail"
                            density="comfortable"
                            variant="outlined"
                            label="Item Pekerjaan"
                        />
                        <div class="grid grid-cols-2 gap-3">
                            <v-number-input
                                v-model="form.volume"
                                :error-messages="form.errors.volume"
                                density="comfortable"
                                variant="outlined"
                                :min="0"
                                grouping="always"
                                label="Volume"
                            />
                            <v-text-field
                                v-model="form.unit"
                                :error-messages="form.errors.unit"
                                density="comfortable"
                                variant="outlined"
                                label="Satuan"
                            />
                        </div>
                        <v-number-input
                            v-model="form.unit_price"
                            :error-messages="form.errors.unit_price"
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
                            :loading="form.processing"
                            type="submit"
                        >
                            Tambahkan
                        </v-btn>
                        <v-btn
                            color="error"
                            variant="flat"
                            :disabled="form.processing"
                            @click="dialog = false"
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
