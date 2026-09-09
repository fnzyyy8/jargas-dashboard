<script setup lang="ts">
import AppDatePicker from '@/components/AppDatePicker.vue';
import { usePlanDetailCreateActions } from '@/pages/projectControl/PlanDetail/Composables/usePlanDetailCreateActions';
import type { Plans } from '@/pages/projectControl/PlanDetail/Types/plan.detail';

const dialog = defineModel<boolean>('modelValue', { default: false });

const props = defineProps<{
    plans: Plans;
}>();

const { planDate, formCreate, submitCreateForm } = usePlanDetailCreateActions(
    props.plans.boq_id,
    props.plans.id,
    () => {
        dialog.value = false;
    },
);
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
                    <div class="flex flex-col">
                        <span class="font-semibold">Tambahkan Rencana</span>
                        <span class="mt-1 text-sm"
                            >[{{ props.plans.customer_category.toUpperCase() }}]
                            - {{ props.plans.item_detail }} ( 1 /
                            {{ props.plans.volume }} )</span
                        >
                    </div>
                </v-card-title>
                <div class="mt-2 grid grid-cols-2 gap-3 px-3">
                    <AppDatePicker
                        v-model="planDate"
                        :min="plans.boq?.project?.start_date"
                        :max="plans.boq?.project?.end_date"
                    />
                    <v-number-input
                        v-model="formCreate.plan_volume"
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
                    <v-btn
                        variant="flat"
                        color="success"
                        type="submit"
                        :loading="formCreate.processing"
                    >
                        Submit
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<style scoped></style>
