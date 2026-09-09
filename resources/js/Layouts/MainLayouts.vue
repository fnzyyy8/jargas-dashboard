<script setup lang="ts">
import AppBreadcrumb from '@/components/AppBreadcrumb.vue';
import AppToast from '@/components/AppToast.vue';
import HeadMenu from '@/Layouts/HeadMenu.vue';
import SideMenu from '@/Layouts/SideMenu.vue';
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <header class="h-16 w-full shrink-0">
            <HeadMenu />
        </header>
        <div class="flex min-h-0 flex-1 overflow-hidden">
            <aside
                class="h-full w-72 shrink-0 overflow-y-auto border-r border-gray-300 bg-white"
            >
                <SideMenu />
            </aside>
            <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
                <div
                    class="flex h-14 shrink-0 items-center border-b border-gray-200 bg-white px-4 md:px-6"
                >
                    <AppBreadcrumb />
                </div>
                <main
                    class="min-h-0 flex-1 overflow-y-auto bg-gray-300 p-4 md:p-6"
                >
                    <slot />
                </main>
            </div>
        </div>
        <AppToast />
    </div>
</template>
