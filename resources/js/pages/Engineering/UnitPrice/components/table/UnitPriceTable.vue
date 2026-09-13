<script setup lang="ts">
import { watch } from 'vue';
import { useUnitPriceTableActions } from '@/pages/Engineering/UnitPrice/composables/useUnitPriceTableActions';
import type {
    PriceList,
    Section,
    UnitPrice,
} from '@/pages/Engineering/UnitPrice/type/unit-price.type';

const props = defineProps<{
    items: Section[];
    priceList: PriceList;
    unitPrices: UnitPrice[];
}>();

const emit = defineEmits<{
    (e: 'update:selected-ids', ids: number[]): void;
    (e: 'update:has-change', value: boolean): void;
}>();

const {
    selectedItemIds,
    allAvailableItemIds,
    isAllSelected,
    isIndeterminate,
    hasChange,
} = useUnitPriceTableActions(
    () => props.items,
    () => props.unitPrices,
);

watch(
    selectedItemIds,
    (newIds) => {
        emit('update:selected-ids', [...newIds]);
    },
    { deep: true, immediate: true },
);

watch(
    hasChange,
    (value) => {
        emit('update:has-change', value);
    },
    {
        immediate: true,
    },
);
</script>

<template>
    <v-card>
        <div
            class="flex items-center justify-between border-b bg-gray-50 px-4 py-2 font-mono text-xs"
        >
            <span>
                Terpilih:
                <strong class="text-primary">{{
                    selectedItemIds.length
                }}</strong>
                / {{ allAvailableItemIds.length }} Item
            </span>
        </div>
        <div class="p-3">
            <v-table fixed-header height="730px" class="mt-3">
                <thead>
                    <tr>
                        <th>
                            <v-checkbox-btn
                                v-model="isAllSelected"
                                :indeterminate="isIndeterminate"
                                color="primary"
                                density="compact"
                            />
                        </th>
                        <th>No</th>
                        <th>Detail Pekerjaan</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <template
                        v-for="section in items"
                        :key="`sec-${section.id}`"
                    >
                        <tr class="bg-gray-300">
                            <td :colspan="5">
                                <strong>{{ section.name }}</strong>
                            </td>
                        </tr>
                        <tr
                            v-for="item in section.item_details"
                            :key="`sec-item-${item.id}`"
                        >
                            <td>
                                <v-checkbox-btn
                                    v-model="selectedItemIds"
                                    :value="item.id"
                                    color="primary"
                                    density="compact"
                                />
                            </td>
                            <td>{{ item.sort_order }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.unit }}</td>
                        </tr>
                        <template
                            v-for="category in section.categories"
                            :key="`cat-${category.id}`"
                        >
                            <tr class="bg-gray-200">
                                <td :colspan="5" class="pl-8">
                                    <strong>
                                        {{ category.name }}
                                    </strong>
                                </td>
                            </tr>
                            <tr
                                v-for="item in category.item_details"
                                :key="`cat-item-${item.id}`"
                            >
                                <td>
                                    <v-checkbox-btn
                                        v-model="selectedItemIds"
                                        :value="item.id"
                                        color="primary"
                                        density="compact"
                                    />
                                </td>
                                <td>{{ item.sort_order }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.unit }}</td>
                            </tr>
                            <template
                                v-for="subCategory in category.sub_categories"
                                :key="`subCat-${subCategory.id}`"
                            >
                                <tr class="bg-gray-100">
                                    <td :colspan="5" class="pl-12">
                                        <strong
                                            >{{ subCategory.name }} :</strong
                                        >
                                    </td>
                                </tr>
                                <tr
                                    v-for="item in subCategory.item_details"
                                    :key="`subCat-item-${item.id}`"
                                >
                                    <td>
                                        <v-checkbox-btn
                                            v-model="selectedItemIds"
                                            :value="item.id"
                                            color="primary"
                                            density="compact"
                                        />
                                    </td>
                                    <td>{{ item.sort_order }}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.unit }}</td>
                                </tr>
                            </template>
                        </template>
                    </template>
                </tbody>
            </v-table>
        </div>
    </v-card>
</template>

<style scoped></style>
