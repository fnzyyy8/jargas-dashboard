<script setup lang="ts">
import { onMounted } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import PriceListInformation from '@/pages/Engineering/PriceListDetail/components/PriceListInformation.vue';
import { usePriceListDetailActions } from '@/pages/Engineering/PriceListDetail/composables/usePriceListDetailActions';
import type { PriceListDetail } from '@/pages/Engineering/PriceListDetail/type/price-list-detail.type';
import { route } from 'ziggy-js';

const { setBreadcrumbs } = useBreadcrumb();

defineProps<{
    priceList: PriceListDetail;
}>();

onMounted(() => {
    setBreadcrumbs([
        {
            title: 'HARSAT',
            href: route('price-list.index'),
        },
        {
            title: 'DETAIL HARSAT',
            disabled: true,
        },
    ]);
});

const { redirectToUnitPrice } = usePriceListDetailActions();
</script>

<template>
    <PriceListInformation
        :price-list="priceList"
        @create-unit-price="(id) => redirectToUnitPrice(id)"
    />
</template>

<style scoped></style>
