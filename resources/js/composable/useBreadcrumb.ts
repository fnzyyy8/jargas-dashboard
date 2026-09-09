import { computed } from 'vue';
import type { BreadCrumbItem } from '@/stores/useBreadcrumbStore';
import { useBreadcrumbStore } from '@/stores/useBreadcrumbStore';

export function useBreadcrumb() {
    const store = useBreadcrumbStore();

    const breadcrumbs = computed(() => store.items);

    const setBreadcrumbs = (items: BreadCrumbItem[]) => {
        store.setBreadcrumbs(items);
    };

    return {
        breadcrumbs,
        setBreadcrumbs,
    };
}
