<script setup lang="ts">
import { ref, watch } from 'vue';
import type { PriceList } from '@/pages/Engineering/UnitPrice/type/unit-price.type';

const props = defineProps<{
    priceList: PriceList;
    isSaving?: boolean;
    hasChanges?: boolean;
}>();

const emit = defineEmits<{
    (e: 'save'): void;
}>();

const isSaved = ref(false);

const handleSave = () => {
    if (props.isSaving || isSaved.value) {
        return;
    }

    emit('save');
};

watch(
    () => props.isSaving,
    (isSaving) => {
        if (isSaving) {
            isSaved.value = true;
        }
    },
    { deep: true },
);
</script>

<template>
    <v-card>
        <div class="grid grid-cols-2 p-3">
            <div>
                <h1>{{ priceList.name }}</h1>
                <span>
                    {{ priceList.number }}
                </span>
            </div>
            <div class="flex items-center justify-end">
                <v-btn
                    :text="props.hasChanges ? 'Save' : 'Saved'"
                    :color="props.hasChanges ? 'success' : 'grey'"
                    :prepend-icon="
                        props.hasChanges
                            ? 'mdi-content-save'
                            : 'mdi-content-save-check'
                    "
                    :disabled="!hasChanges || props.isSaving"
                    :loading="isSaving"
                    variant="flat"
                    @click.prevent="handleSave"
                />
            </div>
        </div>
    </v-card>
</template>

<style scoped></style>
