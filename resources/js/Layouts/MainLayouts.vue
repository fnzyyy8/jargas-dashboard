<script setup lang="ts">
import AppBreadcrumb from '@/components/AppBreadcrumb.vue';
import AppToast from '@/components/AppToast.vue';
import HeadMenu from '@/Layouts/HeadMenu.vue';
import SideMenu from '@/Layouts/SideMenu.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <header class="w-full">
            <HeadMenu />
        </header>
        <div class="flex flex-1 overflow-hidden">
            <aside
                class="shrink-0 overflow-y-auto border-r border-gray-200 bg-white"
            >
                <SideMenu />
            </aside>

            <div class="flex flex-1 flex-col overflow-hidden">
                <div
                    class="flex min-h-14 w-full border-b border-b-gray-200 bg-white px-4 md:px-6 items-center"
                >
                    <AppBreadcrumb />
                </div>
                <main class="flex-1 overflow-y-auto bg-gray-300 p-4 md:p-6">
                    <slot />
                </main>
            </div>
        </div>
        <AppToast />
    </div>
</template>
