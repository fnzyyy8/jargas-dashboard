<script setup lang="ts">
import { onMounted } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import UnitPriceTable from '@/pages/Engineering/UnitPrice/components/table/UnitPriceTable.vue';
import UnitPriceInformation from '@/pages/Engineering/UnitPrice/components/UnitPriceInformation.vue';
import type {
    Section,
    UnitPriceType,
} from '@/pages/Engineering/UnitPrice/type/unit-price.type';
import { route } from 'ziggy-js';

const props = defineProps<{
    unitPrice: UnitPriceType;
    items: Section[];
}>();

const { setBreadcrumbs } = useBreadcrumb();

onMounted(() => {
    setBreadcrumbs([
        {
            title: 'HARSAT',
            href: route('price-list.index'),
        },
        {
            title: 'DETAIL HARSAT',
            href: route('price-list.show', props.unitPrice.id),
        },
        {
            title: 'CREATE HARSAT',
            disabled: true,
        },
    ]);
});
</script>

<template>
    <div class="flex flex-col gap-3">
        <UnitPriceInformation :unit-price="unitPrice" />
        <UnitPriceTable :items="items" />
    </div>
</template>

<style scoped></style>
