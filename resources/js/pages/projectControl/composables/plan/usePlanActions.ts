import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

export function usePlanActions() {
    const redirectToBoq = () => {
        router.visit(route('boq'));
    };

    return {
        redirectToBoq,
    };
}
