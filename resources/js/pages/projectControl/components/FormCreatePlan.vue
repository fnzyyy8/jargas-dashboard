<script setup lang="ts">
import { ref } from 'vue';
import { VTextField } from 'vuetify/components';

const dialog = ref(false);

interface Props {
    density?: VTextField['$props']['density'];
    variant?: VTextField['$props']['variant'];
}

const props = withDefaults(defineProps<Props>(), {
    density: 'comfortable',
    variant: 'outlined',
});
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
            >
                Add Plan
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span>Buat Plan</span>
            </v-card-title>
            <v-card-item>
                <div class="mt-2">
                    <v-autocomplete
                        :density="props.density"
                        :variant="props.variant"
                        label="Section"
                    />
                    <v-autocomplete
                        :density="props.density"
                        :variant="props.variant"
                        label="Category"
                    />
                    <v-autocomplete
                        :density="props.density"
                        :variant="props.variant"
                        label="Sub Category"
                    />
                    <v-textarea
                        :density="props.density"
                        :variant="props.variant"
                        label="Item Pekerjaan"
                    />
                    <div class="grid grid-cols-2 gap-3">
                        <v-number-input
                            :density="props.density"
                            :variant="props.variant"
                            :min="0"
                            grouping="always"
                            label="Volume"
                        />
                        <v-text-field
                            :density="props.density"
                            :variant="props.variant"
                            label="Satuan"
                        />
                    </div>
                    <v-number-input
                        :density="props.density"
                        :variant="props.variant"
                        label="Harga Satuan"
                        :min="0"
                        grouping="always"
                        prefix="Rp"
                    />
                </div>
            </v-card-item>
            <v-card-actions>
                <v-btn color="success" variant="flat"> Tambahkan </v-btn>
                <v-btn color="error" variant="flat" @click="dialog = false">
                    Batal
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
