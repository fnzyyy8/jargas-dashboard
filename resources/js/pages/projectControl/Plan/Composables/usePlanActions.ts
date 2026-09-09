import { router, useForm } from '@inertiajs/vue3';
import { ref, toValue } from 'vue';
import type { MaybeRefOrGetter } from 'vue';
import { route } from 'ziggy-js';

export function usePlanActions(boqId: MaybeRefOrGetter<number>) {
    const isCreateOpen = ref(false);
    const isDeleteOpen = ref(false);
    const isFilterOpen = ref(false);
    const openCreateModal = () => {
        isCreateOpen.value = true;
    };

    const formDelete = useForm({});

    const openFilterModal = () => {
        isFilterOpen.value = true;
    };

    const submitDeleteForm = (planId: number) => {
        const selectedBoqId = toValue(boqId);

        if (!planId || !selectedBoqId) {
            return;
        }

        formDelete.delete(
            route('plan.delete', { boqId: selectedBoqId, id: planId }),
            {
                preserveScroll: true,
                onSuccess: () => {},
            },
        );
    };

    const viewPlanDetail = (planId: number) => {
        const selectedBoqId = toValue(boqId);
        router.visit(
            route('plan.detail.index', { boqId: selectedBoqId, planId }),
        );
    };

    return {
        isCreateOpen,
        isFilterOpen,
        isDeleteOpen,
        openFilterModal,
        openCreateModal,
        submitDeleteForm,
        deleteLoading: formDelete.processing,
        viewPlanDetail,
    };
}
