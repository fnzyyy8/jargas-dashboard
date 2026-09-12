<script setup lang="ts">
import { toRef } from 'vue';
import { useEngineeringUpdateActions } from '@/pages/Engineering/composables/useEngineeringUpdateActions';
import type { PriceList } from '@/pages/Engineering/type/price-list.type';

const dialog = defineModel<boolean>({ default: false });

const props = defineProps<{
    priceList: PriceList | null;
}>();

const priceListRef = toRef(props, 'priceList');

const { formUpdate, submitUpdate } = useEngineeringUpdateActions(
    priceListRef,
    () => {
        dialog.value = false;
    },
);
</script>

<template>
    <v-dialog v-model="dialog" width="700">
        <v-card>
            <v-form @submit.prevent="submitUpdate">
                <div class="flex flex-col gap-3 p-3">
                    <div>
                        <h1>Tambahkan Harga Satuan</h1>
                    </div>
                    <div class="flex flex-col">
                        <v-text-field
                            v-model="formUpdate.name"
                            :error-messages="formUpdate.errors.name"
                            variant="outlined"
                            density="comfortable"
                            label="Nama Harsat"
                        />
                        <v-text-field
                            v-model="formUpdate.number"
                            :error-messages="formUpdate.errors.number"
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
                            :loading="formUpdate.processing"
                        />
                        <v-btn
                            text="Close"
                            color="error"
                            variant="elevated"
                            :disabled="formUpdate.processing"
                            @click="dialog = false"
                        />
                    </div>
                </div>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
