<script setup lang="ts">
import ItemDetailTableAction from '@/pages/projectControl/ItemDetail/components/table/ItemDetailTableAction.vue';
import type { Section } from '@/pages/projectControl/ItemDetail/types/item-detail.type';

defineProps<{
    items: Section[];
}>();

const emit = defineEmits<{
    (e: 'add-item-detail'): void;
}>();
</script>

<template>
    <div class="flex justify-end">
        <v-btn
            prepend-icon="mdi-plus"
            color="success"
            text="Create Item"
            @click="emit('add-item-detail')"
        />
    </div>
    <v-table
        fixed-header
        height="825px"
        class="mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Detail Pekerjaan</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="section in items" :key="`sec-${section.id}`">
                <tr class="bg-gray-300">
                    <td :colspan="4">
                        <strong>{{ section.name }}</strong>
                    </td>
                </tr>
                <tr
                    v-for="item in section.item_details"
                    :key="`sec-item-${item.id}`"
                >
                    <td>{{ item.sort_order }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.unit }}</td>
                    <td><ItemDetailTableAction /></td>
                </tr>
                <template
                    v-for="category in section.categories"
                    :key="`cat-${category.id}`"
                >
                    <tr class="bg-gray-200">
                        <td :colspan="4" class="pl-8">
                            <strong>
                                {{ category.name }}
                            </strong>
                        </td>
                    </tr>
                    <tr
                        v-for="item in category.item_details"
                        :key="`cat-item-${item.id}`"
                    >
                        <td>{{ item.sort_order }}</td>
                        <td>{{ item.name }}</td>
                        <td>{{ item.unit }}</td>
                        <td><ItemDetailTableAction /></td>
                    </tr>
                    <template
                        v-for="subCategory in category.sub_categories"
                        :key="`subCat-${subCategory.id}`"
                    >
                        <tr class="bg-gray-100">
                            <td :colspan="5" class="pl-12">
                                <strong>{{ subCategory.name }} :</strong>
                            </td>
                        </tr>
                        <tr
                            v-for="item in subCategory.item_details"
                            :key="`subCat-item-${item.id}`"
                        >
                            <td>{{ item.sort_order }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.unit }}</td>
                            <td><ItemDetailTableAction /></td>
                        </tr>
                    </template>
                </template>
            </template>
        </tbody>
    </v-table>
</template>

<style scoped></style>
