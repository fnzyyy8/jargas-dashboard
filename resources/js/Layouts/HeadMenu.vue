<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import UserMenu from '@/Layouts/UserMenu.vue';

const page = usePage();

const pageName = computed(() => page.props.page_title);
</script>

<template>
    <div class="flex h-16 items-center justify-between bg-blue-400 px-6">
        <h1>{{ pageName }}</h1>
        <UserMenu />
    </div>
</template>

<style scoped></style>
