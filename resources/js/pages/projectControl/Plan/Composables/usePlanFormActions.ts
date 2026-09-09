import { useForm } from '@inertiajs/vue3';
import { toValue, watchEffect } from 'vue';
import type { MaybeRefOrGetter } from 'vue';
import { route } from 'ziggy-js';

export function usePlanFormActions(
    isMultipleCustomer: MaybeRefOrGetter<boolean>,
) {
    const form = useForm({
        boq_id: 0,
        customer_category: '' as string | string[],
        section: '',
        category: '',
        sub_category: '',
        item_detail: '',
        unit: '',
        volume: 0,
        unit_price: 0,
    });

    watchEffect(() => {
        const isMultiple = toValue(isMultipleCustomer);

        if (!isMultiple) {
            form.customer_category = ['rumah tangga'];
        }
    });

    const submitForm = (boqId: number, onSuccessCallback?: () => void) => {
        form.boq_id = boqId;

        form.post(route('plan.store'), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();

                if (!toValue(isMultipleCustomer)) {
                    form.customer_category = ['rumah tangga'];
                }

                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
        });
    };

    return {
        form,
        submitForm,
    };
}
