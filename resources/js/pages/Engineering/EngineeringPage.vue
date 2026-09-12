<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import FormCreatePriceList from '@/pages/Engineering/components/form/FormCreatePriceList.vue';
import FormUpdatePriceList from '@/pages/Engineering/components/form/FormUpdatePriceList.vue';
import PriceListTable from '@/pages/Engineering/components/table/PriceListTable.vue';
import { useEngineeringActions } from '@/pages/Engineering/composables/useEngineeringActions';
import type { PriceList } from '@/pages/Engineering/type/price-list.type';

const {
    isCreateOpen,
    isUpdateOpen,
    openCreateModal,
    selectedPriceList,
    openUpdateModal,
    submitDelete,
} = useEngineeringActions();

const page = usePage<{
    priceLists: PriceList[];
}>();

const { setBreadcrumbs } = useBreadcrumb();

onMounted(() =>
    setBreadcrumbs([
        {
            title: 'Harsat',
            disabled: true,
        },
    ]),
);
</script>

<template>
    <FormCreatePriceList v-model="isCreateOpen" />
    <FormUpdatePriceList
        :price-list="selectedPriceList"
        v-model="isUpdateOpen"
    />
    <div>
        <v-card>
            <div class="p-3">
                <div class="flex justify-end">
                    <v-btn
                        prepend-icon="mdi-plus"
                        color="success"
                        text="Buat Harsat"
                        @click="openCreateModal"
                    />
                </div>
                <div>
                    <PriceListTable
                        :priceLists="page.props.priceLists"
                        @update-price-list="openUpdateModal"
                        @delete-price-list="submitDelete"
                    />
                </div>
            </div>
        </v-card>
    </div>
</template>

<style scoped></style>
