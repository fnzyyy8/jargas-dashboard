import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

import { route } from 'ziggy-js';

export function useProjectActions() {
    const isDeleteOpen = ref(false);
    const selectedProjectId = ref<number | null>(null);

    const formDelete = useForm({});
    const openDeleteModal = (id: number) => {
        selectedProjectId.value = id;
        isDeleteOpen.value = true;
    };

    const confirmDeleteModal = (onSuccessCallback?: () => void) => {
        if (!selectedProjectId.value) {
            return;
        }

        formDelete.delete(route('projects.destroy', selectedProjectId.value), {
            onSuccess: () => {
                isDeleteOpen.value = false;
                selectedProjectId.value = null;

                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
        });
    };

    return {
        isDeleteOpen,
        deleteLoading: formDelete.processing,
        openDeleteModal,
        confirmDeleteModal,
    };
}
