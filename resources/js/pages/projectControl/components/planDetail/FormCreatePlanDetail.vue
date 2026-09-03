<script setup lang="ts">
import AppDatePicker from '@/components/AppDatePicker.vue';
import type { Plans } from '@/pages/projectControl/types/plan.detail';

const dialog = defineModel<boolean>('modelValue', { default: false });

const props = defineProps<{
    plans: Plans;
}>();
</script>

<template>
    <v-dialog
        v-model="dialog"
        width="700"
        transition="dialog-center-transition"
    >
        <v-card>
            <v-card-title>
                <div class="flex flex-col">
                    <span class="font-semibold">Tambahkan Rencana</span>
                    <span class="mt-1 text-sm"
                        >[{{ props.plans.customer_category.toUpperCase() }}] -
                        {{ props.plans.item_detail }} ( 1 /
                        {{ props.plans.volume }} )</span
                    >
                </div>
            </v-card-title>
            <div class="mt-2 grid grid-cols-2 gap-3 px-3">
                <AppDatePicker
                    :min="plans.boq?.project?.start_date"
                    :max="plans.boq?.project?.end_date"
                />
                <v-number-input
                    :inset="false"
                    controlVariant="hidden"
                    label="Volume"
                    :min="0"
                    grouping="always"
                    density="comfortable"
                    variant="outlined"
                />
            </div>
            <v-card-actions class="px-3">
                <v-btn variant="flat" color="success"> Submit </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
