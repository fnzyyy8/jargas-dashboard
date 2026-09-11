<script setup lang="ts">
const itemDetails = [
    {
        section: {
            name: 'PEKERJAAN PERSIAPAN',
        },
        itemDetail: [
            {
                sort_order: 1,
                name: 'Penyediaan Papan Nama Provek',
                unit: 'Unit',
            },
            {
                sort_order: 2,
                name: 'Sewa Direksi Kit (Include Biaya Consumable)',
                unit: ' Bulan',
            },
        ],
    },
    {
        section: {
            name: 'JARINGAN PIPA DISTRIBUSI',
        },
        category: {
            name: 'MATERIAL PIPA PE 63 mm & AKSESORIS',
        },
        subCategory: {
            name: 'Pipa',
        },
        itemDetail: [
            {
                sort_order: 1,
                name: 'Pipa PE Ø63 mm , MDPE 80/HDPE 100, YELLOW, ISO 4437 SDR 11/SDR 13.6',
                unit: 'm',
            },
        ],
    },
];

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
    <v-table class="mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Detail Pekerjaan</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="(data, index) in itemDetails" :key="index">
                <tr>
                    <td :colspan="4" class="bg-gray-300">
                        <strong>{{ data.section.name }}</strong>
                    </td>
                </tr>
                <tr v-if="data.category">
                    <td :colspan="4" class="bg-gray-200 pl-8">
                        <strong>
                            {{ data.category.name }}
                        </strong>
                    </td>
                </tr>
                <tr v-if="data.subCategory">
                    <td :colspan="4" class="bg-gray-100 pl-10">
                        <strong>
                            {{ data.subCategory.name }}
                        </strong>
                    </td>
                </tr>
                <tr
                    v-for="(item, itemIndex) in data.itemDetail"
                    :key="itemIndex"
                >
                    <td>
                        {{ item.sort_order }}
                    </td>
                    <td>
                        {{ item.name }}
                    </td>
                    <td class="">
                        {{ item.unit }}
                    </td>
                    <td>
                        <v-menu>
                            <template v-slot:activator="{ props }">
                                <v-btn
                                    variant="text"
                                    icon="mdi-dots-vertical"
                                    v-bind="props"
                                />
                            </template>
                            <v-list>
                                <v-list-item
                                    prepend-icon="mdi-pencil"
                                    title="Edit"
                                    base-color="warning"
                                />
                                <v-list-item
                                    prepend-icon="mdi-delete"
                                    title="Delete"
                                    base-color="error"
                                />
                            </v-list>
                        </v-menu>
                    </td>
                </tr>
            </template>
        </tbody>
    </v-table>
</template>

<style scoped></style>
