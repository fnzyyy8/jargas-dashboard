<script setup lang="ts">
import { useCreateItemDetailActions } from '@/pages/projectControl/ItemDetail/composables/useCreateItemDetailActions';

const dialog = defineModel<boolean>({ default: false });

const { formCreate, reset, submitCreate } = useCreateItemDetailActions(() => {
    dialog.value = false;
});

const closeDialog = () => {
    reset();
    dialog.value = false;
};
</script>

<template>
    <v-dialog v-model="dialog" width="700">
        <v-card>
            <v-form @submit.prevent="submitCreate">
                <div class="flex flex-col gap-3 p-3">
                    <div>
                        <h1>Create Form</h1>
                    </div>
                    <div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-combobox
                                variant="outlined"
                                density="comfortable"
                                label="Section"
                                class="col-span-2"
                                v-model="formCreate.section.name"
                            />
                            <v-number-input
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                v-model="formCreate.section.sort_order"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-combobox
                                variant="outlined"
                                density="comfortable"
                                label="Category"
                                class="col-span-2"
                                v-model="formCreate.category.name"
                            />
                            <v-number-input
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                v-model="formCreate.category.sort_order"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-combobox
                                variant="outlined"
                                density="comfortable"
                                label="Sub Category"
                                class="col-span-2"
                                v-model="formCreate.subCategory.name"
                            />
                            <v-number-input
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                v-model="formCreate.subCategory.sort_order"
                            />
                        </div>
                        <div>
                            <v-textarea
                                variant="outlined"
                                density="comfortable"
                                label="Item Detail"
                                v-model="formCreate.itemDetail.name"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-text-field
                                variant="outlined"
                                density="comfortable"
                                label="Unit"
                                class="col-span-2"
                                v-model="formCreate.itemDetail.unit"
                            />
                            <v-number-input
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                v-model="formCreate.itemDetail.sort_order"
                            />
                        </div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <v-btn
                            variant="elevated"
                            color="success"
                            type="submit"
                            text="Submit"
                        />
                        <v-btn
                            variant="elevated"
                            color="error"
                            text="Batal"
                            @click="closeDialog"
                        />
                    </div>
                </div>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
