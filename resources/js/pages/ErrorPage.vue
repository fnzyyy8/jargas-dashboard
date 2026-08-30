<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    status: Number,
});

const title = computed(() => {
    return (
        {
            503: '503',
            500: '500',
            404: '404',
            403: '403',
        }[props.status ?? 0] || 'Terjadi Masalah yang tidak di ketahui'
    );
});

const description = computed(() => {
    return (
        {
            503: 'Kami sedang melakukan Pemeliharaan',
            500: 'Maaf, terjadi kesalahan pada server',
            404: 'Maaf, Halaman tidak ditemukan',
            403: 'Maaf anda tidak memiliki akses ke halaman ini',
        }[props.status ?? 0] || 'Terjadi masalah yang tidak diketahui'
    );
});

const directToDashboard = () => {
    router.visit(route('home'));
};
</script>

<template>
    <div
        class="flex h-full flex-col items-center justify-center rounded-md bg-white"
    >
        <div class="my-3 flex flex-col items-center">
            <span class="text-xl font-semibold text-red-500">{{ title }}</span>
            <span>{{ description }}</span>
        </div>
        <v-btn color="error" @click="directToDashboard">Dashboard</v-btn>
    </div>
</template>

<style scoped></style>
