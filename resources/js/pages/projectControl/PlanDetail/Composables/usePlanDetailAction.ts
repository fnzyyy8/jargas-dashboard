import { ref } from 'vue';

export function usePlanDetailAction() {
    const isCreateOpen = ref(false);

    return {
        isCreateOpen,
    };
}
