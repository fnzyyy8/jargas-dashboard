<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import UnitPriceTable from '@/pages/Engineering/UnitPrice/components/table/UnitPriceTable.vue';
import UnitPriceInformation from '@/pages/Engineering/UnitPrice/components/UnitPriceInformation.vue';
import { useUnitPriceActions } from '@/pages/Engineering/UnitPrice/composables/UseUnitPriceActions';
import type {
    PriceList,
    Section,
    UnitPrice,
} from '@/pages/Engineering/UnitPrice/type/unit-price.type';
import { route } from 'ziggy-js';

const props = defineProps<{
    priceList: PriceList;
    unitPrice: UnitPrice[];
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
            href: route('price-list.show', props.priceList.id),
        },
        {
            title: 'CREATE HARSAT',
            disabled: true,
        },
    ]);
});

const selectedItemsIds = ref<number[]>([]);
const hasChange = ref(false);

const handleSelectedItemsUpdate = (ids: number[]) => {
    selectedItemsIds.value = ids;
};

const handleChangesUpdate = (value: boolean) => {
    hasChange.value = value;
};

const { isSaving, handleSave } = useUnitPriceActions(
    () => props.priceList,
    selectedItemsIds,
);
</script>

<template>
    <div class="flex flex-col gap-3">
        <UnitPriceInformation
            :price-list="priceList"
            :is-saving="isSaving"
            :has-changes="hasChange"
            @save="handleSave"
        />
        <UnitPriceTable
            :price-list="priceList"
            :unit-prices="unitPrice"
            :items="items"
            @update:selected-ids="handleSelectedItemsUpdate"
            @update:has-change="handleChangesUpdate"
        />
    </div>
</template>

<style scoped></style>
