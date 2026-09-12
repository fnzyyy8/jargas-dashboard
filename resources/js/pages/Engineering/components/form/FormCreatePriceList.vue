<script setup lang="ts">
import { useEngineeringCreateActions } from '@/pages/Engineering/composables/useEngineeringCreateActions';

const dialog = defineModel<boolean>({ default: false });

const { formCreate, submitCreate } = useEngineeringCreateActions(() => {
    dialog.value = false;
});
</script>

<template>
    <v-dialog v-model="dialog" width="700">
        <v-card>
            <v-form @submit.prevent="submitCreate">
                <div class="flex flex-col gap-3 p-3">
                    <div>
                        <h1>Tambahkan Harga Satuan</h1>
                    </div>
                    <div class="flex flex-col">
                        <v-text-field
                            v-model="formCreate.name"
                            :error-messages="formCreate.errors.name"
                            variant="outlined"
                            density="comfortable"
                            label="Nama Harsat"
                        />
                        <v-text-field
                            v-model="formCreate.number"
                            :error-messages="formCreate.errors.number"
                            variant="outlined"
                            density="comfortable"
                            label="Nomor Harsat"
                        />
                    </div>
                    <div class="flex justify-end gap-2">
                        <v-btn
                            text="Submit"
                            color="success"
                            variant="elevated"
                            type="submit"
                            :loading="formCreate.processing"
                        />
                        <v-btn
                            text="Close"
                            color="error"
                            variant="elevated"
                            :disabled="formCreate.processing"
                            @click="dialog = false"
                        />
                    </div>
                </div>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
