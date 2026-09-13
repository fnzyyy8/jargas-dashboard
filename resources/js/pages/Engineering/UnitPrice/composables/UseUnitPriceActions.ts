import { useForm } from '@inertiajs/vue3';
import type { MaybeRefOrGetter, Ref } from 'vue';
import { toValue } from 'vue';
import type { PriceList } from '@/pages/Engineering/UnitPrice/type/unit-price.type';
import { route } from 'ziggy-js';

export function useUnitPriceActions(
    priceList: MaybeRefOrGetter<PriceList>,
    selectedItemIds: Ref<number[]>,
) {
    const form = useForm({
        item_detail_ids: [] as number[],
    });

    const handleSave = () => {
        form.item_detail_ids = [...selectedItemIds.value];

        form.post(route('unit-price.sync', toValue(priceList).id), {
            preserveScroll: true,
            onSuccess: () => {
                console.log('Unit prices synchronized successfully.');
            },
            onError: (e) => {
                console.error(e);
            },
        });
    };

    return {
        form,
        isSaving: form.processing,
        handleSave,
    };
}
