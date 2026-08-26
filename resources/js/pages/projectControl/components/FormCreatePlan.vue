<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { VTextField } from 'vuetify/components';

const dialog = ref(false);

interface Props {
    density?: VTextField['$props']['density'];
    variant?: VTextField['$props']['variant'];
    projectId?: number | null;
}

const props = withDefaults(defineProps<Props>(), {
    density: 'comfortable',
    variant: 'outlined',
});

const form = useForm({
    project_id: props.projectId,
    section: '',
    category: '',
    sub_category: '',
    item_detail: '',
    volume: null as number | null,
    unit: '',
    unit_price: null as number | null,
});

const submit = () => {
    form.project_id = props.projectId;

    form.post('/project-control/plan', {
        preserveScroll: true,
        onSuccess: () => {
            dialog.value = false;
            form.reset();
        },
    });
};
</script>

<template>
    <v-dialog
        v-model="dialog"
        width="700"
        transition="dialog-center-transition"
    >
        <template v-slot:activator="{ props: activatorProps }">
            <v-btn
                prepend-icon="mdi-plus"
                color="success"
                v-bind="activatorProps"
                :disabled="!projectId"
            >
                Add Plan
            </v-btn>
        </template>
        <v-card>
            <v-form @submit.prevent="submit">
                <v-card-title>
                    <span>Buat Plan</span>
                </v-card-title>
                <v-card-item>
                    <div class="mt-2">
                        <v-combobox
                            v-model="form.section"
                            :density="props.density"
                            :variant="props.variant"
                            :error-messages="form.errors.section"
                            label="Section"
                        />
                        <v-autocomplete
                            v-model="form.category"
                            :density="props.density"
                            :variant="props.variant"
                            :error-messages="form.errors.category"
                            label="Category"
                        />
                        <v-autocomplete
                            v-model="form.sub_category"
                            :error-messages="form.errors.sub_category"
                            :density="props.density"
                            :variant="props.variant"
                            label="Sub Category"
                        />
                        <v-textarea
                            v-model="form.item_detail"
                            :error-messages="form.errors.item_detail"
                            :density="props.density"
                            :variant="props.variant"
                            label="Item Pekerjaan"
                        />
                        <div class="grid grid-cols-2 gap-3">
                            <v-number-input
                                v-model="form.volume"
                                :error-messages="form.errors.volume"
                                :density="props.density"
                                :variant="props.variant"
                                :min="0"
                                grouping="always"
                                label="Volume"
                            />
                            <v-text-field
                                v-model="form.unit"
                                :error-messages="form.errors.unit"
                                :density="props.density"
                                :variant="props.variant"
                                label="Satuan"
                            />
                        </div>
                        <v-number-input
                            v-model="form.unit_price"
                            :error-messages="form.errors.unit_price"
                            :density="props.density"
                            :variant="props.variant"
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
                            @click="dialog = false"
                            :disabled="form.processing"
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
