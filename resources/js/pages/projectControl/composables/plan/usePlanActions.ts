import { router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { route } from 'ziggy-js';

export function usePlanActions() {
    const isCreateOpen = ref(false);
    const isDeleteOpen = ref(false);
    const selectedPlanId = ref<number | null>(0);
    const redirectToBoq = () => {
        router.visit(route('boq'));
    };

    const deleteForm = useForm({});

    const openDeleteModal = (id: number) => {
        selectedPlanId.value = id;
        isDeleteOpen.value = true;
    };

    const confirmDeleteModal = (onSuccessCallback?: () => void) => {
        if (!selectedPlanId.value) {
            return;
        }

        deleteForm.delete(route('plan.destroy', selectedPlanId.value), {
            onSuccess: () => {
                isDeleteOpen.value = false;
                selectedPlanId.value = null;

                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
        });
    };

    return {
        isCreateOpen,
        isDeleteOpen,
        deleteLoading: deleteForm.processing,
        openDeleteModal,
        confirmDeleteModal,
        redirectToBoq,
    };
}
