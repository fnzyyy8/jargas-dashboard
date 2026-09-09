<script setup lang="ts">
import type { Boq } from '@/pages/projectControl/Plan/Types/plan.type';

const props = defineProps<{
    boq: Boq;
}>();
</script>

<template>
    <v-card>
        <div class="grid grid-cols-2 p-3">
            <div>
                <span class="text-lg text-gray-400">
                    {{ props.boq.project.project_number }}
                </span>
                <div class="mt-2">
                    <h2 class="text-black">
                        {{ props.boq.project.project_name }}
                    </h2>
                    <span class="text-sm text-gray-400">
                        {{ props.boq.project.client }} -
                        {{ props.boq.project.area.toUpperCase() }}
                        ( {{ props.boq.detailed_area.toUpperCase() }} )
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-end">
                <div
                    v-if="props.boq.isMultipleCustomer"
                    class="flex w-24 flex-col items-center"
                >
                    <VIcon icon="mdi-account-group" />
                    <span class="text-xs">Multi Pelanggan</span>
                </div>

                <span class="flex w-24 flex-col items-center" v-else>
                    <VIcon icon="mdi-account" />
                    <span class="text-xs">Rumah Tangga</span>
                </span>
            </div>
        </div>
    </v-card>
</template>

<style scoped></style>
