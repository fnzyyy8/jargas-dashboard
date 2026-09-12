import { ref } from 'vue';

export function useEngineeringActions() {
    const isCreateOpen = ref(false);

    const openCreateModal = () => {
        isCreateOpen.value = true;
    };

    return {
        isCreateOpen,
        openCreateModal,
    };
}
