<script setup lang="ts">
import { onMounted } from 'vue';
import { useBreadcrumb } from '@/composable/useBreadcrumb';
import FormCreateItemDetail from '@/pages/projectControl/ItemDetail/components/form/FormCreateItemDetail.vue';
import ItemDetailTable from '@/pages/projectControl/ItemDetail/components/table/ItemDetailTable.vue';
import { useItemDetailActions } from '@/pages/projectControl/ItemDetail/composables/useItemDetailActions';

const { setBreadcrumbs } = useBreadcrumb();

onMounted(() => {
    setBreadcrumbs([
        {
            title: 'BOQ ITEMS',
            disabled: true,
        },
    ]);
});

const { isCreateOpen, openCreateDialog } = useItemDetailActions();
</script>

<template>
    <div>
        <FormCreateItemDetail v-model="isCreateOpen" />
        <v-card>
            <div class="p-3">
                <ItemDetailTable @add-item-detail="openCreateDialog" />
            </div>
        </v-card>
    </div>
</template>

<style scoped></style>
