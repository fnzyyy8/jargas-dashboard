import { useForm } from '@inertiajs/vue3';
import type { Ref } from 'vue';
import { watch } from 'vue';

import type { PriceList } from '@/pages/Engineering/type/price-list.type';
import { route } from 'ziggy-js';

export function useEngineeringUpdateActions(
    priceListRef: Ref<PriceList | null>,
    onSuccessCallback?: () => void,
) {
    const formUpdate = useForm({
        name: '',
        number: '',
    });

    watch(
        priceListRef,
        (priceList) => {
            if (priceList) {
                formUpdate.name = priceList.name;
                formUpdate.number = priceList.number;
            }
        },
        { immediate: true },
    );

    const submitUpdate = () => {
        formUpdate.put(route('price-list.update', priceListRef.value?.id), {
            onSuccess: () => {
                formUpdate.reset();

                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
        });
    };

    return {
        formUpdate,
        submitUpdate,
    };
}
