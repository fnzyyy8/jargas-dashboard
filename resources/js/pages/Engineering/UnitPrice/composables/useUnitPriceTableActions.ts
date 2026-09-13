import { computed, ref, toValue } from 'vue';
import type { MaybeRefOrGetter } from 'vue';
import type { Section } from '@/pages/Engineering/UnitPrice/type/unit-price.type';

export function useUnitPriceTableActions(items: MaybeRefOrGetter<Section[]>) {
    const selectedItemIds = ref<number[]>([]);

    const allAvailableItemIds = computed<number[]>(() => {
        const ids: number[] = [];
        const rawItems = toValue(items);

        if (!Array.isArray(rawItems)) {
            return ids;
        }

        rawItems.forEach((sec) => {
            sec.item_details?.forEach((item) => ids.push(item.id));

            sec.categories?.forEach((cat) => {
                cat.item_details?.forEach((item) => ids.push(item.id));

                cat.sub_categories?.forEach((sub) => {
                    sub.item_details?.forEach((item) => ids.push(item.id));
                });
            });
        });

        return ids;
    });

    const isAllSelected = computed({
        get: () =>
            allAvailableItemIds.value.length > 0 &&
            selectedItemIds.value.length === allAvailableItemIds.value.length,

        set: (val: boolean) => {
            if (val) {
                selectedItemIds.value = [...allAvailableItemIds.value];
            } else {
                selectedItemIds.value = [];
            }
        },
    });

    const isIndeterminate = computed(() => {
        return (
            selectedItemIds.value.length > 0 &&
            selectedItemIds.value.length < allAvailableItemIds.value.length
        );
    });

    const clearSelection = () => {
        selectedItemIds.value = [];
    };

    return {
        selectedItemIds,
        allAvailableItemIds,
        isAllSelected,
        isIndeterminate,
        clearSelection,
    };
}
