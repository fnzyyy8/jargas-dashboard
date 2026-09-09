import { useForm } from '@inertiajs/vue3';
import { ref, toValue } from 'vue';

import type { MaybeRefOrGetter } from 'vue';
import { route } from 'ziggy-js';

export function usePlanDetailCreateActions(
    boqId: MaybeRefOrGetter<number>,
    planId: MaybeRefOrGetter<number>,
    onSuccessCallback?: () => void,
) {
    const planDate = ref<Date | null>(null);

    const formCreate = useForm({
        plan_id: 0,
        plan_date: '',
        plan_volume: 0,
    });

    const submitCreateForm = () => {
        formCreate.plan_date = planDate.value
            ? planDate.value.toLocaleDateString('en-CA')
            : '';

        const selectedBoq = toValue(boqId);
        const selectedPlan = toValue(planId);

        formCreate.plan_id = selectedPlan;

        formCreate.post(
            route('plan.detail.create', {
                boqId: selectedBoq,
                planId: selectedPlan,
            }),
            {
                onSuccess: () => {
                    formCreate.reset();

                    if (onSuccessCallback) {
                        onSuccessCallback();
                    }
                },
            },
        );
    };

    return {
        formCreate,
        planDate,
        submitCreateForm,
    };
}
