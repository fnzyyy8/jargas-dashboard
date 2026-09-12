<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { useCreateItemDetailActions } from '@/pages/projectControl/ItemDetail/composables/useCreateItemDetailActions';
import type { ItemDetailOptions } from '@/pages/projectControl/ItemDetail/types/item-detail.type';

const dialog = defineModel<boolean>({ default: false });

const page = usePage<{
    itemDetailOptions: ItemDetailOptions;
}>();

const {
    formCreate,

    sections,
    categories,
    subCategories,

    selectedSection,
    selectedCategory,
    selectedSubCategory,

    isSectionSortReadonly,
    isCategorySortReadonly,
    isSubCategorySortReadonly,

    submitCreate,
    reset,
} = useCreateItemDetailActions(page.props.itemDetailOptions, () => {
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
                                v-model="selectedSection"
                                :items="sections"
                                item-title="name"
                                variant="outlined"
                                density="comfortable"
                                label="Section"
                                class="col-span-2"
                                autocomplete="off"
                                clearable
                            />
                            <v-number-input
                                v-model="formCreate.section.sort_order"
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                :readonly="isSectionSortReadonly"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-combobox
                                v-model="selectedCategory"
                                :items="categories"
                                item-title="name"
                                variant="outlined"
                                density="comfortable"
                                label="Category"
                                class="col-span-2"
                                autocomplete="off"
                                :disabled="!selectedSection"
                                clearable
                            />
                            <v-number-input
                                v-model="formCreate.category.sort_order"
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                :readonly="isCategorySortReadonly"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-combobox
                                v-model="selectedSubCategory"
                                :items="subCategories"
                                item-title="name"
                                variant="outlined"
                                density="comfortable"
                                label="Sub Category"
                                class="col-span-2"
                                autocomplete="off"
                                :disabled="!selectedCategory"
                                clearable
                            />
                            <v-number-input
                                variant="outlined"
                                density="comfortable"
                                label="Sort"
                                control-variant="hidden"
                                :min="0"
                                v-model="formCreate.subCategory.sort_order"
                                :readonly="isSubCategorySortReadonly"
                            />
                        </div>
                        <div>
                            <v-textarea
                                v-model="formCreate.itemDetail.name"
                                variant="outlined"
                                density="comfortable"
                                label="Item Detail"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <v-text-field
                                v-model="formCreate.itemDetail.unit"
                                variant="outlined"
                                density="comfortable"
                                label="Unit"
                                class="col-span-2"
                                autocomplete="off"
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
