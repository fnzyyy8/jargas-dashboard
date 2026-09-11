import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export function useCreateItemDetailActions(onSuccessCallback?: () => void) {
    const formCreate = useForm({
        section: {
            name: '',
            sort_order: 0,
        },

        category: {
            name: '',
            sort_order: 0,
        },

        subCategory: {
            name: '',
            sort_order: 0,
        },

        itemDetail: {
            name: '',
            sort_order: 0,
            unit: '',
        },
    });

    const submitCreate = () => {
        console.log(formCreate.data());
        formCreate.post(route('item-details.create'), {
            onSuccess: () => {
                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
            onError: (error) => {
                console.log(error);
            },
        });
    };

    const reset = () => {
        formCreate.reset();
        formCreate.clearErrors();
    };

    return {
        formCreate,
        submitCreate,
        reset,
    };
}
