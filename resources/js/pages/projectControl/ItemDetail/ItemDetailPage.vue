<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import FormCreateItemDetail from '@/pages/projectControl/ItemDetail/components/form/FormCreateItemDetail.vue';
import ItemDetailTable from '@/pages/projectControl/ItemDetail/components/table/ItemDetailTable.vue';
import { useItemDetailActions } from '@/pages/projectControl/ItemDetail/composables/useItemDetailActions';
import type { ItemDetailOptions } from '@/pages/projectControl/ItemDetail/types/item-detail.type';

const { setBreadcrumbs } = useBreadcrumb();

onMounted(() => {
    setBreadcrumbs([
        {
            title: 'BOQ ITEMS',
            disabled: true,
        },
    ]);
});

const page = usePage<{
    itemDetailOptions: ItemDetailOptions;
    itemDetails: any;
}>();

const { isCreateOpen, openCreateDialog } = useItemDetailActions();
</script>

<template>
    <div>
        <FormCreateItemDetail v-model="isCreateOpen" />
        <v-card>
            <div class="p-3">
                <ItemDetailTable
                    @add-item-detail="openCreateDialog"
                    :items="page.props.itemDetails"
                />
            </div>
        </v-card>
    </div>
</template>

<style scoped></style>
