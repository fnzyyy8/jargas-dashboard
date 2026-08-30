import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export function usePlanFormActions() {
    const form = useForm({
        boq_id: 0,
        section: '',
        category: '',
        sub_category: '',
        item_detail: '',
        unit: '',
        volume: 0,
        unit_price: 0,
    });

    const submitForm = (boqId: number, onSuccessCallback?: () => void) => {
        form.boq_id = boqId;
        form.post(route('plan.store'), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();

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
