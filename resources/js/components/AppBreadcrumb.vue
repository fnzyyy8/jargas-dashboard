<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { useBreadcrumbStore } from '@/stores/useBreadcrumbStore';

const breadCrumbStore = useBreadcrumbStore();
</script>

<template>
    <nav v-if="breadCrumbStore.items.length > 0" class="py-2">
        <v-breadcrumbs
            :items="breadCrumbStore.items"
            density="compact"
            class="px-0 text-sm"
        >
            <template v-slot:item="{ item }">
                <li v-if="item.href && !item.disabled">
                    <Link
                        :href="item.href"
                        class="font-medium text-blue-600 decoration-1 underline-offset-2 transition-colors hover:text-blue-800 hover:underline"
                    >
                        {{ item.title }}
                    </Link>
                </li>
                <li v-else class="font-semibold text-gray-500">
                    {{ item.title }}
                </li>
            </template>
            <template v-slot:divider>
                <v-icon size="x-small" color="grey-medium-1"
                    >mdi-chevron-right</v-icon
                >
            </template>
        </v-breadcrumbs>
    </nav>
</template>

<style scoped></style>
