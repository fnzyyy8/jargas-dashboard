<script setup lang="ts">
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

type ItemType = {
    title: string;
    icon?: string;
    href?: string;
    children?: ItemType[];
};

const page = usePage();

const open = ref<string[]>([]);

const items: ItemType[] = [
    {
        title: 'Dashboard',
        icon: 'mdi-view-dashboard',
        href: '/',
    },
    {
        title: 'Project',
        icon: 'mdi-office-building',
        children: [
            {
                title: 'SPK Awal',
                href: '/projects',
            },
        ],
    },
    {
        title: 'Project Control',
        icon: 'mdi-hard-hat',
        children: [
            {
                title: 'Boq',
                href: '/project-control/boq',
            },
        ],
    },
];

const navigate = (url?: string) => {
    if (!url) {
        return;
    }

    router.visit(url);
};

const isActive = (href?: string) => {
    if (!href) {
        return false;
    } else {
        return page.url === href;
    }
};
</script>
<template>
    <div class="w-full">
        <v-list v-model:opened="open">
            <template v-for="(item, index) in items" :key="index">
                <v-list-group v-if="item.children" :value="item.title">
                    <template #activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            :title="item.title"
                            :prepend-icon="item.icon"
                        />
                    </template>
                    <v-list-item
                        v-for="(child, childIndex) in item.children"
                        :key="childIndex"
                        :title="child.title"
                        :value="child.title"
                        color="primary"
                        :active="isActive(child.href)"
                        @click="navigate(child.href)"
                    />
                </v-list-group>
                <v-list-item
                    v-else
                    color="primary"
                    :title="item.title"
                    :prepend-icon="item.icon"
                    :active="isActive(item.href)"
                    @click="navigate(item.href)"
                    link
                />
            </template>
        </v-list>
    </div>
</template>

<style scoped></style>
