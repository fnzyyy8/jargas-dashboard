<script setup lang="ts">
import { onMounted } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import PlanFilter from '@/pages/projectControl/Plan/Components/Filter/PlanFilter.vue';
import FormCreatePlan from '@/pages/projectControl/Plan/Components/Form/FormCreatePlan.vue';
import PlanProjectInformation from '@/pages/projectControl/Plan/Components/PlanProjectInformation.vue';
import PlanTable from '@/pages/projectControl/Plan/Components/Table/PlanTable.vue';
import { usePlanActions } from '@/pages/projectControl/Plan/Composables/usePlanActions';
import type { Boq, Plan } from '@/pages/projectControl/Plan/Types/plan.type';
import { route } from 'ziggy-js';

const props = defineProps<{
    boq: Boq;
    plans?: Plan[];
}>();

const {
    isCreateOpen,
    isFilterOpen,
    openCreateModal,
    openFilterModal,
    submitDeleteForm,
    viewPlanDetail,
} = usePlanActions(props.boq.id);

const { setBreadcrumbs } = useBreadcrumb();

onMounted(() => {
    setBreadcrumbs([
        {
            title: 'BOQ',
            href: route('boq'),
        },
        {
            title: 'PLAN',
            disabled: true,
        },
    ]);
});
</script>

<template>
    <PlanFilter :boq="boq" v-model="isFilterOpen" />
    <FormCreatePlan
        v-model="isCreateOpen"
        :boq-id="boq.id"
        :is-multiple-customer="Boolean(boq.isMultipleCustomer)"
    />
    <div class="flex flex-col gap-3">
        <PlanProjectInformation :boq="boq" />
        <v-card>
            <div class="p-3">
                <PlanTable
                    :plans="plans"
                    @filter="openFilterModal"
                    @view-plan="viewPlanDetail"
                    @create-plan="openCreateModal"
                    @delete-plan="(planId) => submitDeleteForm(planId)"
                />
            </div>
        </v-card>
    </div>
</template>

<style scoped></style>
