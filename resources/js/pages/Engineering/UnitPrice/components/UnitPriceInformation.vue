<script setup lang="ts">
import { ref } from 'vue';
import type { UnitPriceType } from '@/pages/Engineering/UnitPrice/type/unit-price.type';

const props = defineProps<{
    unitPrice: UnitPriceType;
    isSaving?: boolean;
}>();

const emit = defineEmits<{
    (e: 'save'): void;
}>();

const isSaved = ref(false);

const onSaveClick = () => {
    if (isSaved.value) {
        return;
    }

    emit('save');

    isSaved.value = true;
};
</script>

<template>
    <v-card>
        <div class="grid grid-cols-2 p-3">
            <div>
                <h1>{{ props.unitPrice.name }}</h1>
                <span>
                    {{ props.unitPrice.number }}
                </span>
            </div>
            <div class="flex items-center justify-end">
                <v-btn
                    :text="isSaved ? 'Saved' : 'Save'"
                    :color="isSaved ? 'grey-lighten-1' : 'success'"
                    :prepend-icon="isSaved ? 'mdi-check' : 'mdi-content-save'"
                    :disabled="isSaved"
                    :loading="props.isSaving"
                    variant="flat"
                    @click="onSaveClick"
                />
            </div>
        </div>
    </v-card>
</template>

<style scoped></style>
