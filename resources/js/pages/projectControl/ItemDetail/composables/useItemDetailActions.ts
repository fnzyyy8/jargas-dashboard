import { ref } from 'vue';

export function useItemDetailActions() {
    const isCreateOpen = ref(false);

    const openCreateDialog = () => {
        isCreateOpen.value = true;
    };

    return {
        isCreateOpen,
        openCreateDialog,
    };
}
