<script setup lang="ts">
import UserMenu from '@/Layouts/UserMenu.vue';
</script>

<template>
    <div class="flex h-16 items-center justify-between bg-blue-950 px-6">
        <v-img
            max-height="30"
            max-width="120"
            src="/images/pgn_logo.png"
            alt="Logo Pgas"
            aspect-ratio="16/9"
            cover
        />
        <UserMenu />
    </div>
</template>

<style scoped></style>
