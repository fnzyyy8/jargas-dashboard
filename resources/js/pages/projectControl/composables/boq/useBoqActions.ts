import { useForm } from '@inertiajs/vue3';

import { ref } from 'vue';
import { route } from 'ziggy-js';

export function useBoqActions() {
    const isCreateOpen = ref(false);
    const isDeleteOpen = ref(false);
    const selectedBoqId = ref<number | null>(null);

    const deleteForm = useForm({});

    const openDeleteModal = (id: number) => {
        selectedBoqId.value = id;
        isDeleteOpen.value = true;
    };

    const confirmDeleteModal = (onSuccessCallback?: () => void) => {
        if (!selectedBoqId.value) {
            return;
        }

        deleteForm.delete(route('boq.destroy', selectedBoqId.value), {
            onSuccess: () => {
                isDeleteOpen.value = false;
                selectedBoqId.value = null;

                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
        });
    };

    return {
        isCreateOpen,
        isDeleteOpen,
        selectedBoqId,
        deleteLoading: deleteForm.processing,
        openDeleteModal,
        confirmDeleteModal,
    };
}
