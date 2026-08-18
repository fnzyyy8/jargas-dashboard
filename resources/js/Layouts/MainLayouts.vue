<script setup lang="ts">
import HeadMenu from '@/Layouts/HeadMenu.vue';
import SideMenu from '@/Layouts/SideMenu.vue';
</script>

<template>
    <div class="flex min-h-screen">
        <aside class="shrink-0">
            <side-menu />
        </aside>

        <div class="flex flex-1 flex-col overflow-hidden">
            <header>
                <head-menu />
            </header>

            <main class="flex-1 overflow-y-auto bg-gray-200 p-4 md:p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
