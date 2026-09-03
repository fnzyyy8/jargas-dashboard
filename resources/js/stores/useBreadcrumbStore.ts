import { defineStore } from 'pinia';
import { ref } from 'vue';

export interface BreadCrumbItem {
    title: string;
    disabled?: boolean;
    href?: string;
}

export const useBreadcrumbStore = defineStore('breadcrumb', () => {
    const items = ref<BreadCrumbItem[]>([]);

    const setBreadcrumbs = (newItems: BreadCrumbItem[]) => {
        items.value = newItems;
    };

    const clearBreadcrumbs = () => {
        items.value = [];
    };

    return {
        items,
        setBreadcrumbs,
        clearBreadcrumbs,
    };
});
