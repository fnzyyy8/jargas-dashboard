<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { VTextField } from 'vuetify/components';
</script>

<template>
    <v-dialog width="700" transition="dialog-center-transition">
        <v-card>
            <v-form @submit.prevent="">
                <v-card-title>
                    <span>Buat Plan</span>
                </v-card-title>
                <v-card-item>
                    <div class="mt-2">
                        <v-combobox
                            density="comfortable"
                            variant="outlined"
                            label="Section"
                        />
                        <v-autocomplete
                            density="comfortable"
                            variant="outlined"
                            label="Category"
                        />
                        <v-autocomplete
                            density="comfortable"
                            variant="outlined"
                            label="Sub Category"
                        />
                        <v-textarea
                            density="comfortable"
                            variant="outlined"
                            label="Item Pekerjaan"
                        />
                        <div class="grid grid-cols-2 gap-3">
                            <v-number-input
                                density="comfortable"
                                variant="outlined"
                                :min="0"
                                grouping="always"
                                label="Volume"
                            />
                            <v-text-field
                                density="comfortable"
                                variant="outlined"
                                label="Satuan"
                            />
                        </div>
                        <v-number-input
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
                        <v-btn color="success" variant="flat" type="submit">
                            Tambahkan
                        </v-btn>
                        <v-btn color="error" variant="flat"> Batal </v-btn>
                    </div>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
