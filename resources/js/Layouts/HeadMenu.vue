<script setup lang="ts">
import UserMenu from '@/Layouts/UserMenu.vue';
</script>

<template>
    <div class="flex h-16 w-full items-center justify-between bg-blue-950 px-6">
        <img
            src="/images/pgn_logo.png"
            alt="Logo Pgas"
            class="h-7.5 w-30 object-contain"
        />
        <UserMenu />
    </div>
</template>

<style scoped></style>
