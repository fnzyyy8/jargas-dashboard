import { useForm } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

import type { Ref } from 'vue';
import type { ProjectOption } from '@/pages/projectControl/types/boq.type';
import { route } from 'ziggy-js';

export function useBoqFormActions(
    projects: Ref<ProjectOption[]>,
    onSuccessCallback?: () => void,
) {
    const selectedCategory = ref<string | null>(null);

    const form = useForm({
        project_id: null as number | null,
        detailed_area: '',
    });

    const filteredProjects = computed(() => {
        const projectList = projects.value || [];

        if (!selectedCategory.value) {
            return projectList;
        }

        return projects.value.filter(
            (p) => p.category === selectedCategory.value,
        );
    });

    watch(selectedCategory, () => {
        form.project_id = null;
    });

    const resetForm = () => {
        form.reset();
        form.clearErrors();
        selectedCategory.value = null;
    };

    const submitForm = () => {
        form.post(route('boq.store'), {
            preserveScroll: true,
            onSuccess: () => {
                resetForm();

                if (onSuccessCallback) {
                    onSuccessCallback();
                }
            },
        });
    };

    return {
        form,
        selectedCategory,
        filteredProjects,
        resetForm,
        submitForm,
    };
}
